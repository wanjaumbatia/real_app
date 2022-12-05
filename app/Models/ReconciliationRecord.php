<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReconciliationRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'expected_amount', 'submited_amount', 'shortage', 'shortage_amount',
        'branch', 'reconciled_by', 'reconciled_on', 'min', 'max', 'reconciliation_reference'
    ];
}
