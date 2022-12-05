<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'sent_to',
        'subject',
        'message',
        'sent',
        'delivered'
    ];
}
