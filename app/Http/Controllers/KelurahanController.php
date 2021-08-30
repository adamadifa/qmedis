<?php

namespace App\Http\Controllers;

use App\Kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    function getkelurahan(Request $request)
    {
        $id_kecamatan = $request->id_kecamatan;
        if (isset($request->id_kelurahan)) {
            $id_kelurahan = $request->id_kelurahan;
        } else {
            $id_kelurahan = "";
        }
        $kelurahan = Kelurahan::where('district_id', $id_kecamatan)->get();
        return view('kelurahan.showbydistrict', compact('kelurahan', 'id_kelurahan'));
    }
}
