<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'savings_account_id', 
        'plan', 'customer_id', 
        'customer', 
        'transaction_type',
        'status', 
        'pof', 
        'remarks', 
        'amount', 
        'commission', 
        'total', 
        'handler', 
        'requires_approval', 
        'approved',
        'posted', 
        'batch_number', 
        'branch', 
        'reconciled', 
        'admin_reconciled', 
        'reconciliation_reference', 
        'reconciled_by', 
        'reconciled_on',
        'otp'
    ];
}
