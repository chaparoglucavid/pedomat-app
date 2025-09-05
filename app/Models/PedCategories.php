<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedCategories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ped_categories';
    protected $fillable = ['category_name','reason_for_use','status','unit_price']; // unit_price də əlavə et
    protected $casts = ['unit_price' => 'decimal:2'];

    public function equipment_ped_stock()
    {
        return $this->hasMany(EquipmentPedStock::class, 'ped_category_id');
    }

    public function equipments()
    {
        return $this->belongsToMany(
            Equipments::class,
            'equipment_ped_stocks',
            'ped_category_id',
            'equipment_id'
        )->withPivot(['qty_available'])->withTimestamps();
    }
}
