<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'savings_account_id', 'plan', 'customer_id', 'customer',
        'transaction_type', 'status', 'amount', 'branch', 'handler', 'batch_number',
        'reconciliation_reference', 'posted', 'status'
    ];
}
