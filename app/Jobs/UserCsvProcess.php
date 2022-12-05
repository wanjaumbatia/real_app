<?php

namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class UserCsvProcess implements ShouldQueue
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
            User::create([
                'name'=>$userData['name'],
                'phone'=>'0'.$userData['phone'],
                'username'=>$userData['email'],
                'email'=>$userData['email'],
                'password'=>Hash::make($userData['password']),
                'email_verified_at'=>Carbon::now(),
                'description'=>'Sales Executive',
                'branch'=>$userData['branch'],
                'type'=>'Field',
                'role'=>'Sales Executive'
            ]);
        }
    }

    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
        Log::error($exception);
    }
}
