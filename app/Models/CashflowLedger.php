<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashflowLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch', 'from', 'to', 'debit', 'credit', 'amount', 'description', 'status', 'remarks',
        'created_by', 'batch'
    ];
}
