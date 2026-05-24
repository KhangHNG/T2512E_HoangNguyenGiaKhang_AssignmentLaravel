<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BankAccount extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'bank_accounts';

    protected $fillable = [
        'account_number',
        'full_name',
        'email',
        'phone',
        'balance',
        'status',
    ];
}
