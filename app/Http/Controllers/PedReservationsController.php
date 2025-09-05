<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;

class PedReservationsController extends Controller
{
    public function store(Request $request){
        $barcode = new DNS1D();
        return $barcode->getBarcodeHTML('120101030', 'PHARMA2T');
    }
}
