<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class ApotekController extends Controller
{
    function index(Request $request)
    {
        $title = "Data Apotek";
        $apotek = DB::table('apotek')->get();
        return view('apotek.index', compact('title', 'apotek'));
    }

    function create()
    {
        $title = "Input Data Apotek";

        //Cek Dokter Terakhir
        $cekapotek = DB::table('apotek')
            ->select('kode_apotek')
            ->orderBy('kode_apotek', 'desc')
            ->first();
        if (empty($cekapotek->kode_apotek)) {
            $kode_apotek_terakhir = "SP000";
        } else {
            $kode_apotek_terakhir = $cekapotek->kode_supplier;
        }
        $kode_apotek = buatkode($kode_apotek_terakhir, "AP", 3);
        return view('apotek.create', compact('kode_apotek', 'title'));
    }

    function edit($id)
    {
        $title = "Edit Data Apotek";
        $apotek = DB::table('apotek')
            ->where('kode_apotek', $id)
            ->first();
        return view('apotek.edit', compact('title',  'apotek'));
    }

    function store(Request $request)
    {
        $request->validate([
            'kode_apotek' => 'required|unique:apotek',
            'nama_apotek' => 'required',
            'no_telepon'  => 'numeric'
        ]);


        try {
            $simpan = DB::table('apotek')->insert([
                'kode_apotek' => $request->kode_apotek,
                'nama_apotek' => $request->nama_apotek,
                'sia_no'      => $request->sia_no,
                'pemilik'     => $request->pemilik,
                'apoteker'    => $request->apoteker,
                'alamat'      => $request->alamat,
                'no_telepon'  => $request->no_telepon,
            ]);
            if ($simpan) {
                return redirect('/apotek')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/apotek')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            return redirect('/apotek')->with(['failed' => $errorcode]);
        }
    }

    function update(Request $request)
    {
        $request->validate([
            'nama_apotek' => 'required',
            'no_telepon'  => 'numeric'
        ]);



        try {
            $simpan = DB::table('apotek')
                ->where('kode_apotek', $request->kode_apotek)
                ->update([
                    'nama_apotek' => $request->nama_apotek,
                    'sia_no'      => $request->sia_no,
                    'pemilik'     => $request->pemilik,
                    'apoteker'    => $request->apoteker,
                    'alamat'      => $request->alamat,
                    'no_telepon'  => $request->no_telepon,
                ]);
            if ($simpan) {
                return redirect('/apotek')->with(['success' => 'Data Berhasil Update']);
            } else {
                return redirect('/apotek')->with(['failed' => 'Data Gagal Update']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            return redirect('/apotek')->with(['failed' => $errorcode]);
        }
    }

    function show($id)
    {
        $title = 'Profil Apotek';
        $apotek = DB::table('apotek')
            ->where('kode_apotek', $id)
            ->first();
        return view('apotek.show', compact('title', 'apotek'));
    }

    function delete($id)
    {
        try {
            $hapus = DB::table('apotek')
                ->where('kode_apotek', $id)
                ->delete();
            if ($hapus) {
                return redirect('/apotek')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/apotek')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/apotek')->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }
}
