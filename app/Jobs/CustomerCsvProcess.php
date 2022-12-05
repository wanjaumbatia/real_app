<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\Plan;
use App\Models\SavingsAccounts;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class CustomerCsvProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data   = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $user) {
            $userData = array_combine($this->header, $user);
            $old = true;
            $phone = '';
            // if ($userData['created_at'] == 'NULL') {
            //     $old = true;
            // }

            if ($userData['phone'] != '' || $userData['phone'] != null) {
                $phone = '0' . $userData['phone'];
            }

            $customer = Customer::create([
                'name' => $userData['name'],
                'phone' => $phone,
                'address' => $userData['address'],
                'handler' => $userData['handler'],
                'branch' => $userData['branch'],
                'old' => $old,
                'phone_verified' => 0
            ]);

            $plan = Plan::where('default', true)->first();
            //create savings account
            $acc = SavingsAccounts::create([
                'customer_id' => $customer->id,
                'customer' => $customer->name,
                'plan_id' => $plan->id,
                'plan' => $plan->name,
                'name' => $plan->name,
                'branch' => $customer->branch,
                'pledge' => 0,
                'handler' => $customer->handler,
                'created_by' => 'Admin'
            ]);
        }
    }

    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
    }
}
