<?php

namespace App\Jobs;

use App\Models\BankAccount;
use App\Models\BankAccountLedger;
use App\Models\Payments;
use App\Models\ReconciliationRecord;
use App\Models\SavingsAccountLedger;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReconciliationProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $record = ReconciliationRecord::where('id', $this->id)->first();
        $collection = Payments::where('admin_reconciled', false)->where('status', 'pending')->where('handler', $record->name)->get();

        foreach ($collection as $item) {
            if ($item->transaction_type == 'savings') {
                $bank = BankAccount::where('branch', $record->branch)->first();                
                //bank account
                $bank = BankAccountLedger::create([
                    'posting_date' => $record->reconciled_on,
                    'bank_account_id' => $bank->id,
                    'bank_name' => $bank->name,
                    'transaction_type' => 'savings',
                    'credit' => 0,
                    'debit' => $item->amount,
                    'amount' => $item->amount,
                    'batch' => $record->reconciliation_reference
                ]);

                //savings account
                $savings = SavingsAccountLedger::create([
                    'posting_date' => $record->reconciled_on,
                    'customer_id' => $item->customer_id,
                    'customer' => $item->customer,
                    'savings_account_id' => $item->savings_account_id,
                    'batch' => $record->reconciliation_reference,
                    'plan' => $item->plan,
                    'transaction_type' => 'savings',
                    'description' => 'savings',
                    'debit' => 0,
                    'credit' => $item->amount,
                    'amount' => $item->amount * -1
                ]);


                $item->admin_reconciled = true;
                $item->reconciled_on = $record->reconciled_on;
                $item->reconciled_by = $record->reconciled_by;
                $item->status = 'confirmed';
                $item->posted = true;
                $item->reconciliation_reference = $record->reconciliation_reference;
                $item->update();
            }
        }
    }
}
