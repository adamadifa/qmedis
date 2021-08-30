<?php

namespace App\Http\Controllers;

use App\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    function getkota(Request $request)
    {
        $id_propinsi = $request->id_propinsi;
        if (isset($request->id_kota)) {
            $id_kota = $request->id_kota;
        } else {
            $id_kota = "";
        }
        $kota = Kota::where('province_id', $id_propinsi)->get();
        return view('kota.showbyprovinces', compact('kota', 'id_kota'));
    }
}
