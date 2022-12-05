<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccountLedger extends Model
{
    use HasFactory;
    protected $fillable = [
        'posting_date',
        'bank_account_id',
        'bank_name',
        'transaction_type',
        'debit',
        'credit',
        'amount'
    ];
}
