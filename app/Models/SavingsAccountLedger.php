<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsAccountLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'posting_date','batch','customer_id','customer', 'savings_account_id',
        'plan','transaction_type','description','debit', 'credit','amount','reconciled', 'reversed'
    ];
    
}
