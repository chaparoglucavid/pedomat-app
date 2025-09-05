<?php

namespace App\Http\Controllers;

use App\Models\Equipments;
use Native\Mobile\Dialog;

class EquipmentsController extends Controller
{

    public function index()
    {
        $equipments = Equipments::isActive()
            ->with(['equipment_ped_stock:id,equipment_id,qty_available'])
            ->orderBy('equipment_number')
            ->get()
            ->map(function ($equipment) {
                $equipment->qty_list = $equipment->equipment_ped_stock->pluck('qty_available');
                return $equipment;
            });

        return view('welcome', compact('equipments'));
    }

    public function equipmentDetails($equipment_id)
    {
        $equipment = Equipments::isActive()
            ->with([
                'ped_categories' => function ($q) {
                    $q->select('ped_categories.id','category_name')
                        ->withPivot(['qty_available']);
                }
            ])
            ->find(decrypt($equipment_id));

        if (!$equipment) {
            $dialog = new Dialog();
            $dialog->toast('Cihaz tapılmadı!');
            return redirect()->back();
        }
        $equipment->qty_list = $equipment->equipment_ped_stock->pluck('qty_available');
        return view('equipments.equipment-details', compact('equipment'));
    }

}
