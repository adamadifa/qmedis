<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    function getkecamatan(Request $request)
    {
        $id_kota = $request->id_kota;
        if (isset($request->id_kecamatan)) {
            $id_kecamatan = $request->id_kecamatan;
        } else {
            $id_kecamatan = "";
        }
        $kecamatan = Kecamatan::where('regency_id', $id_kota)->get();
        return view('kecamatan.showbyregencies', compact('kecamatan', 'id_kecamatan'));
    }
}
