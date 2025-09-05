<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserBalanceHistory extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'user_balance_history';
    protected $fillable = [
        'user_id',
        'transaction_number',
        'amount',
        'payment_via',
        'payment_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
