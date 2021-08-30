<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class PersentaselabaController extends Controller
{
    function index(Request $request)
    {
        $title = "Data Persentase Laba";
        $persentaselaba = DB::table('persentase_laba')->get();
        return view('persentaselaba.index', compact('title', 'persentaselaba'));
    }

    function create()
    {
        $title = "Input Data Persentase laba";
        return view('persentaselaba.create', compact('title'));
    }

    function edit($id)
    {
        $title = "Edit Data Persentase Laba";
        $persentaselaba = DB::table('persentase_laba')
            ->where('id_persentaselaba', $id)
            ->first();
        return view('persentaselaba.edit', compact('title',  'persentaselaba'));
    }

    function store(Request $request)
    {
        $request->validate([
            'kategori_laba' => 'required|unique:persentase_laba',
            'persentase' => 'required|numeric',
        ]);


        try {
            $simpan = DB::table('persentase_laba')->insert([
                'kategori_laba' => $request->kategori_laba,
                'persentase' => $request->persentase,
            ]);
            if ($simpan) {
                return redirect('/persentaselaba')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/persentaselaba')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            return redirect('/persentaselaba')->with(['failed' => $errorcode]);
        }
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'kategori_laba' => 'required',
            'persentase' => 'required|numeric',
        ]);


        try {
            $simpan = DB::table('persentase_laba')
                ->where('id_persentaselaba', $id)
                ->update([
                    'kategori_laba' => $request->kategori_laba,
                    'persentase' => $request->persentase,
                ]);
            if ($simpan) {
                return redirect('/persentaselaba')->with(['success' => 'Data Berhasil Update']);
            } else {
                return redirect('/persentaselaba')->with(['failed' => 'Data Gagal Update']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            return redirect('/persentaselaba')->with(['failed' => $errorcode]);
        }
    }

    function delete($id)
    {
        try {
            $hapus = DB::table('persentase_laba')
                ->where('id_persentaselaba', $id)
                ->delete();
            if ($hapus) {
                return redirect('/persentaselaba')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/persentaselaba')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/persentaselaba')->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }
}
