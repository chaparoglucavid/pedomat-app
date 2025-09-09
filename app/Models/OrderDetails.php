<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class OrderDetails extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'ped_category_id',
        'qty',
        'unit_price',
        'total_price'
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id', 'id');
    }
}
