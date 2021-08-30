<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    function penjualan()
    {
        $apotek = DB::table('apotek')->get();
        $title = "Data Penjualan";
        return view('penjualan.laporan.form.frm_lappenjualan', compact('title', 'apotek'));
    }

    function cetakpenjualan(Request $request)
    {

        return view('penjualan.laporan.cetak.penjualan');
    }
}
