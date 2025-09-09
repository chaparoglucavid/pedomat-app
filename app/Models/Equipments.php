<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Equipments extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'equipments';
    protected $fillable = [
        'equipment_number',
        'equipment_name',
        'general_capacity',
        'battery_level',
        'current_address',
        'equipment_status'
    ];

    public function scopeIsActive($q){ return $q->where('equipment_status','active'); }
    public function scopeIsDeactive($q){ return $q->where('equipment_status','deactive'); }
    public function scopeIsUnderRepair($q){ return $q->where('equipment_status','under_repair'); }

    public function equipment_ped_stock()
    {
        return $this->hasMany(EquipmentPedStock::class, 'equipment_id');
    }

    public function ped_categories()
    {
        return $this->belongsToMany(
            PedCategories::class,
            'equipment_ped_stocks',
            'equipment_id',
            'ped_category_id'
        )->withPivot(['qty_available'])->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'equipment_id', 'id');
    }

}
