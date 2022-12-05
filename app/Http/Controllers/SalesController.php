<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OtpCode;
use App\Models\payments;
use App\Models\Plan;
use App\Models\SavingsAccountLedger;
use App\Models\SavingsAccounts;
use App\Models\SMSMessage;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SalesController extends Controller
{
    public function customers(Request $request)
    {
        $customers = Customer::where('handler', auth()->user()->name)->get();
        foreach ($customers as $item) {
            $balance = SavingsAccountLedger::where('customer_id', $item->id)->sum('amount') * -1;
            $item->balance = $balance;
        }
        return view('sales.customers.index')->with(['customers' => $customers]);
    }

    public function customer(Request $request, $id)
    {
        $customer = Customer::where('id', $id)->first();
        //check if user is handeler
        if ($customer->handler != auth()->user()->name) {
            return abort(403);
        }

        $plans = Plan::where('active', true)->get();

        //get user plans
        $accounts = SavingsAccounts::where('customer_id', $customer->id)->orderBy('id', 'ASC')->where('active', true)->get();
        $acs = array();
        foreach ($accounts as $item) {
            $acc = array();
            $balance = SavingsAccountLedger::where('savings_account_id', $item->id)->sum('amount') * -1;
            $pending = Payments::where('savings_account_id', $item->id)->where('status', 'pending')->sum('amount');
            $pending_withdrawal = Withdrawal::where('savings_account_id', $item->id)->where('status', 'pending')->sum('amount');
            $acc['id'] = $item->id;
            $acc['name'] = $item->name;
            $acc['plan'] = $item->plan;
            $acc['balance'] = $balance;
            $acc['pending'] = $pending;
            $acc['pending_withdrawal'] = $pending_withdrawal;

            $acs[] = $acc;
            //get pending withdrawal
            //get plan
        }

        return view('sales.customers.customer')->with(['customer' => $customer, 'plans' => $plans, 'accounts' => $acs]);
    }

    public function new_customer(Request $request)
    {
        return view('sales.customer.new');
    }

    public function create_account($id, Request $request)
    {

        $plan = Plan::where('id', $request->plan)->first();
        $customer = Customer::where('id', $id)->first();
        $name = $plan->name;
        if ($request->name != null) {
            $name = $request->name;
        }
        $acc = SavingsAccounts::create([
            'customer_id' => $customer->id,
            'customer' => $customer->name,
            'plan_id' => $plan->id,
            'plan' => $plan->name,
            'name' => $name,
            'branch' => $customer->branch,
            'pledge' => 0,
            'handler' => $customer->handler,
            'created_by' => 'Admin'
        ]);

        return redirect()->to('/sep/customer/' . $customer->id);
    }

    public function collection(Request $request, $id)
    {
        $customer = Customer::where('id', $id)->first();
        $accounts = SavingsAccounts::where('customer_id', $id)->get();
        return view('sales.customers.collection')->with(['customer' => $customer, 'accounts' => $accounts]);
    }

    public function collection_post(Request $request)
    {
        try {
            $batch = $this->generateRandomString(32);
            $reference = rand(100000000, 999999999);
            $total = 0;
            $customer = null;
            foreach ($request->transactions as $item) {
                if ($item['amount'] != 0) {
                    $acc = SavingsAccounts::where('id', $item['id'])->first();
                    $customer_id = $acc->customer_id;
                    $customer = Customer::where('id', $acc->customer_id)->first();
                    //insert into table
                    Log::info($item);
                    $payment = Payments::create([
                        'savings_account_id' => $acc->id,
                        'plan' => 'plan',
                        'customer_id' => $customer_id,
                        'customer' => $customer->name,
                        'transaction_type' => 'savings',
                        'status' => 'pending',
                        'amount' => $item['amount'],
                        'branch' => $customer->branch,
                        'batch_number' => $batch,
                        'handler' => auth()->user()->name
                    ]);
                    $total = $total + $item['amount'];
                }
            }

            //send notification
            SMSMessage::create([
                'sent_to' => $customer->name,
                'phone' => $customer->phone,
                'subject' => "Payment Acknowledgement",
                'message' => "Thanks for your patronage we rec'vd " . number_format($total, 0) . " for inquires call 09021417778",
                'sent' => true
            ]);

            return response([
                'success' => true,
                'message' => 'Payment made successfully.'
            ]);
        } catch (Throwable $e) {
            Log::error($e);
            return response([
                'success' => false,
                'message' => 'Payment failed.'
            ]);
        }
    }

    public function withdrawal(Request $request, $id)
    {
        $acc = SavingsAccounts::where('id', $id)->first();
        $plan = Plan::where('id', $acc->plan_id)->first();

        $balance = SavingsAccountLedger::where('savings_account_id', $id)->sum('amount') * -1;

        return view('sales.customers.withdrawal')->with(['account' => $acc, 'balance' => $balance, 'plan' => $plan]);
    }

    public function withdrawal_post(Request $request, $id)
    {
        try {
            $acc = SavingsAccounts::where('id', $id)->first();
            $plan = Plan::where('id', $acc->plan_id)->first();
            $total = $request->amount + $request->commission;
            $balance = SavingsAccountLedger::where('savings_account_id', $id)->sum('amount') * -1;

            //check balance
            if ($total > $balance) {
                return response([
                    'success' => false,
                    'message' => 'You can not withdraw more that ' . number_format($balance - $request->commission)
                ]);
            }

            //check pending withdrawals
            $pending_withdrawals = Withdrawal::where('status', 'pending')->where('savings_account_id', $id)->sum('total');
            if ($pending_withdrawals + $total > $balance) {
                return response([
                    'success' => false,
                    'message' => 'This customer has a pending withdrawal.'
                ]);
            }

            if ($plan->regular == true) {
                //check minimum charge
                $expected_commission = $request->amount * $plan->charge;

                if ($expected_commission > $request->commission) {
                    return response([
                        'success' => true,
                        'prompt_commission' => true,
                        'message' => 'The commission you have entered is lower the expected commission'
                    ]);
                } else {
                    //save the withdrawal
                    $pof = false;
                    $otp = 123456;

                    $withdrawal = Withdrawal::create([
                        'savings_account_id' => $acc->id,
                        'plan' => $acc->plan,
                        'customer_id' => $acc->customer_id,
                        'customer' => $acc->customer,
                        'transaction_type' => 'withdrawal',
                        'status' => 'pending',
                        'pof' => $pof,
                        'remarks' => 'Withdrawal Request',
                        'amount' => $request->amount,
                        'commission' => $request->commission,
                        'total' => $total,
                        'handler' => $acc->handler,
                        'branch' => $acc->branch,
                        'otp' => (string)$otp
                    ]);

                    $customer = Customer::where('id', $acc->customer_id)->first();
                    $opt = OtpCode::create([
                        'customer' => $customer->name,
                        'sent_to' => $customer->phone,
                        'code' => $otp,
                        'active' => true
                    ]);

                    $msg = 'Thanks for your patronage, use ' . $otp . ' to complete  the withdrawal of ' . number_format($request->amount, 0) . ' from REAL COOPERATIVE REALdoe. For enquiries call 09021417778';

                    $sms = SMSMessage::create([
                        'sent_to' => $customer->name,
                        'phone' => $customer->phone,
                        'subject' => "Withdrawa OTP",
                        'message' => $msg,
                        'sent' => true
                    ]);

                    return response([
                        'success' => true,
                        'otp_sent' => true,
                        'message' => 'Please verify using the otp send to customer'
                    ]);
                }
            } else if ($plan->savings == true) {
            } elseif ($plan->invest == true) {
            } else {
                return response([
                    'success' => false,
                    'message' => 'An error has occured. please contact the system administrator.'
                ]);
            }
        } catch (Throwable $e) {
            Log::error($e);
            return response([
                'success' => false,
                'message' => 'An error has occured. please contact the system administrator'
            ]);
        }
    }

    public function reconciliation(Request $request)
    {
        $collection = DB::table('reconciliation_records')
            ->select(DB::raw('sum(submited_amount) as collection'), 'reconciled_on')
            ->groupBy('reconciled_on')
            ->orderByDesc('reconciled_on')
            ->where('name', auth()->user()->name)
            ->get();

        foreach ($collection as $item) {
            $item->withdrawals = Withdrawal::where('handler', auth()->user()->name)
                ->whereDate('reconciled_on', $item->reconciled_on)
                ->sum('amount');

            $item->loans = 5000;
            $item->registration = 1000;
        }

        return view('sales.recon.report')->with(['data' => $collection]);
    }

    public function savings_logs()
    {
        $savings = Payments::where('handler', auth()->user()->name)->orderBy('id', 'DESC')->get();
        return view('sales.logs.savings')->with(['data' => $savings]);
    }

    public function withdrawal_logs()
    {
        $withdrawals = Withdrawal::where('handler', auth()->user()->name)->orderBy('id', 'DESC')->get();
        return view('sales.logs.withdrawals')->with(['data' => $withdrawals]);
    }

    public function loan_repayments_logs()
    {
        return view('sales.logs.loan_repayment');
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
