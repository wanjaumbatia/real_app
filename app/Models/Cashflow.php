<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch', 'from', 'to', 'amount', 'description', 'status', 'remarks',
        'created_by', 'confirmed_by', 'batch'
    ];
}
