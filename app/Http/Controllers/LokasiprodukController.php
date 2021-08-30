<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;

class LokasiprodukController extends Controller
{
    function index(Request $request)
    {
        $title = "Data Lokasi Produk";
        $lokasiproduk = DB::table('lokasi_produk')->get();
        return view('lokasiproduk.index', compact('title', 'lokasiproduk'));
    }

    function create()
    {
        $title = "Input Data Lokasi Produk";
        return view('lokasiproduk.create', compact('title'));
    }

    function edit($id)
    {
        $title = "Edit Data Lokasi Produk";
        $lokasiproduk = DB::table('lokasi_produk')
            ->where('id_lokasiproduk', $id)
            ->first();
        return view('lokasiproduk.edit', compact('title',  'lokasiproduk'));
    }

    function store(Request $request)
    {
        $request->validate([
            'lokasi_produk' => 'required|unique:lokasi_produk',
        ]);


        try {
            $simpan = DB::table('lokasi_produk')->insert([
                'lokasi_produk' => $request->lokasi_produk,
            ]);
            if ($simpan) {
                return redirect('/lokasiproduk')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/lokasiproduk')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            return redirect('/lokasiproduk')->with(['failed' => $errorcode]);
        }
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'lokasi_produk' => 'required',
        ]);


        try {
            $simpan = DB::table('lokasi_produk')
                ->where('id_lokasiproduk', $id)
                ->update([
                    'lokasi_produk' => $request->lokasi_produk,
                ]);
            if ($simpan) {
                return redirect('/lokasiproduk')->with(['success' => 'Data Berhasil Update']);
            } else {
                return redirect('/lokasiproduk')->with(['failed' => 'Data Gagal Update']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            return redirect('/lokasiproduk')->with(['failed' => $errorcode]);
        }
    }

    function delete($id)
    {
        try {
            $hapus = DB::table('lokasi_produk')
                ->where('id_lokasiproduk', $id)
                ->delete();
            if ($hapus) {
                return redirect('/lokasiproduk')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/lokasiproduk')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            $message = $e->getMessage();
            if ($errorcode == 23000) {
                return redirect('/lokasiproduk')->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            } else {
                return redirect('/lokasiproduk')->with(['failed' => $message]);
            }
        }
    }
}
