<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restock extends Model
{
    protected $table = 'restock';
    protected $fillable = [
        'user_id',
        'equipment_id',
        'ped_category_id',
        'qty_added',
        'note'
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipments::class, 'equipment_id');
    }

    public function ped_category()
    {
        return $this->belongsTo(PedCategories::class, 'ped_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
