<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentPedStock extends Model
{
    protected $table = 'equipment_ped_stocks';
    protected $fillable = ['equipment_id','ped_category_id','qty_available'];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipments::class, 'equipment_id');
    }

    public function ped_category(): BelongsTo
    {
        return $this->belongsTo(PedCategories::class, 'ped_category_id');
    }
}
