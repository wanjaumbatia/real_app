<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMSMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sent_to', 
        'phone', 
        'subject', 
        'message', 
        'sent', 
        'delivered'
    ];

}
