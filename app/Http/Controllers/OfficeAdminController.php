<?php

namespace App\Http\Controllers;

use App\Jobs\ReconciliationProcess;
use App\Models\BankAccount;
use App\Models\BankAccountLedger;
use App\Models\Cashflow;
use App\Models\CashflowLedger;
use App\Models\Email;
use App\Models\Expense;
use App\Models\ExpensesCode;
use App\Models\Payments;
use App\Models\ReconciliationRecord;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class OfficeAdminController extends Controller
{
    public function reconciliation()
    {
        //savings
        $collection = DB::table('payments')
            ->select('handler', DB::raw('sum(amount) as collection'))
            ->groupBy('handler')
            ->where('admin_reconciled', false)
            ->where('status', 'pending')
            ->get();


        $withdrawals = DB::table('withdrawals')
            ->select('handler', DB::raw('sum(amount) as collection'))
            ->groupBy('handler')
            ->where('admin_reconciled', false)
            ->where('status', 'pending')
            ->get();
        $withdrawal =
            $data = array();
        foreach ($collection as $item) {
            $data1 = array();
            $data1['handler'] = $item->handler;
            $data1['collection'] = $item->collection;
            $data1['withdrawals'] = Withdrawal::where('handler', $item->handler)->where('admin_reconciled', false)
                ->where('status', 'pending')->sum('amount');

            $data1['pof'] = Withdrawal::where('handler', $item->handler)->where('admin_reconciled', false)
                ->where('status', 'pending')->where('pof', true)->sum('amount');

            $data1['expected'] = $data1['collection'] - $data1['pof'];
            $data[] = $data1;
        }



        return view('office_admin.recon.reconciliation')->with(['data' => $data]);
    }

    public function reconcile(Request $request, $name)
    {
        //calculate total
        $collection = Payments::where('admin_reconciled', false)->where('status', 'pending')->where('handler', $name)->get();
        $total = Payments::where('admin_reconciled', false)->where('status', 'pending')->where('handler', $name)->sum('amount');

        return view('office_admin.recon.reconcile')->with(['total' => $total, 'collection' => $collection, 'name' => $name]);
    }

    public function reconcile_post(Request $request, $name)
    {
        $total = Payments::where('admin_reconciled', false)->where('status', 'pending')->where('handler', $name)->sum('amount');
        $reference = $this->generateRandomString(20);
        if ($total > $request->submited) {
            //fetch shortage users
            //generate email
            $mail = Email::create([
                'customer' => $name,
                'sent_to' => 'wanjaumbatia@gmail.com',
                'subject' => 'Shortage Alert',
                'message' => 'Shortage message'
            ]);
            //reconconcile

            //add shortage line

        } else if ($total < $request->submited) {
            dd('over');
        } else {
            $collection = Payments::where('admin_reconciled', false)->where('status', 'pending')->where('handler', $name)->get();
            $min = Payments::where('admin_reconciled', false)->where('status', 'pending')->where('handler', $name)->first();
            $max = Payments::where('admin_reconciled', false)->where('status', 'pending')->orderby('id', 'desc')->where('handler', $name)->first();
            $batch  = Bus::batch([])->dispatch();
            $record = ReconciliationRecord::create([
                'name' => $name,
                'expected_amount' => $total,
                'submited_amount' => $request->submited,
                'branch' => auth()->user()->branch,
                'reconciled_by' => auth()->user()->name,
                'reconciled_on' => Carbon::now(),
                'min' => $min->id,
                'max' => $max->id,
                'reconciliation_reference' => $reference
            ]);

            $batch->add(new ReconciliationProcess($record->id));

            return redirect()->to('/reconcile/' . $name);
        }
    }

    public function recon_withdrawal_list($name)
    {
        $withdrawals = Withdrawal::where('handler', $name)->where('status', 'pending')->get();
        return view('office_admin.recon.withdrawals')->with(['data' => $withdrawals]);
    }

    public function recon_withdrawal_page($id)
    {
        $withdrawal = Withdrawal::Where('id', $id)->first();
        return view('office_admin.recon.withdrawal')->with(['data' => $withdrawal]);
    }

    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }

    public function cashflow_approval(Request $request)
    {
        $data = Cashflow::where('branch', auth()->user()->branch)->get();
        return view('office_admin.finance.cashflow')->with(['data' => $data]);
    }

    public function confirm_cashflow(Request $request, $id)
    {
        $cashflow = Cashflow::where('id', $id)->first();
        $reference = $this->generateRandomString(20);
        $bank = BankAccount::where('branch', $cashflow->branch)->first();
        //bank account
        if ($cashflow->to == 'HQ') {
            $bank = BankAccountLedger::create([
                'posting_date' => Carbon::now(),
                'bank_account_id' => $bank->id,
                'bank_name' => $bank->name,
                'transaction_type' => 'savings',
                'debit' => 0,
                'credit' => $cashflow->amount,
                'amount' => $cashflow->amount * -1,
                'batch' => $reference
            ]);
            $cashflowLedger = CashflowLedger::create([
                'branch' => $cashflow->branch,
                'to' => 'HQ',
                'from' => $cashflow->branch,
                'credit' => 0,
                'debit' => $cashflow->amount,
                'amount' => $cashflow->amount,
                'description' => $cashflow->description,
                'created_by' => auth()->user()->name,
                'batch' => $reference
            ]);
        } else {
            $bank = BankAccountLedger::create([
                'posting_date' => Carbon::now(),
                'bank_account_id' => $bank->id,
                'bank_name' => $bank->name,
                'transaction_type' => 'savings',
                'credit' => 0,
                'debit' => $cashflow->amount,
                'amount' => $cashflow->amount,
                'batch' => $reference
            ]);
            $cashflowLedger = CashflowLedger::create([
                'branch' => $cashflow->branch,
                'to' => 'HQ',
                'from' => $cashflow->branch,
                'debit' => 0,
                'credit' => $cashflow->amount,
                'amount' => $cashflow->amount * -1,
                'description' => $cashflow->description,
                'created_by' => auth()->user()->name,
                'batch' => $reference
            ]);
        }
        $cashflow->batch = $reference;
        $cashflow->status = 'confirmed';
        $cashflow->confirmed_by = auth()->user()->name;
        $cashflow->update();

        return redirect()->to('/approve_cashflow');
    }


    public function expenses()
    {
        $expenses = Expense::where('branch', auth()->user()->branch)->get();
        return view('office_admin.finance.expenses.index')->with(['data' => $expenses]);
    }

    public function create_expense()
    {
        $codes = ExpensesCode::all();
        return view('office_admin.finance.expenses.create')->with(['codes' => $codes]);
    }

    public function store_expenses(Request $request)
    {
        $code = ExpensesCode::where('id', $request->type)->first();
        $expense = Expense::create([
            'branch' => auth()->user()->branch,
            'description'  => $request->description,
            'status' => 'pending',
            'approved' => false,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'type' => $code->expense_type,
            'created_by' => auth()->user()->name
        ]);

        return redirect()->to('/expenses');
    }

    public function BankBalance()
    {
        $banks = BankAccount::where('branch', auth()->user()->branch)->get();

        foreach ($banks as $item) {
            $balance = BankAccountLedger::where('bank_account_id', $item->id)->sum('amount');
            $item->balance = $balance;
        }
        return view('office_admin.finance.bank')->with(['banks' => $banks]);
    }

    public function cash_summary()
    {
        return view('office_admin.finance.cash_summary');
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
