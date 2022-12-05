<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsAccounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer',
        'plan_id',
        'plan',
        'name',
        'branch',
        'pledge',
        'handler',
        'created_by'
    ];
}
