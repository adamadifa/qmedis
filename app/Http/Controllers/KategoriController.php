<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class KategoriController extends Controller
{
    function index(Request $request)
    {
        $title = "Data Kategori";
        $kategori = DB::table('kategori')->get();
        return view('kategori.index', compact('title', 'kategori'));
    }

    function create()
    {
        $title = "Input Data Kategori";
        return view('kategori.create', compact('title'));
    }


    function edit($id)
    {
        $title = "Edit Data Kategori";
        $kategori = DB::table('kategori')
            ->where('id_kategori', $id)
            ->first();
        return view('kategori.edit', compact('title',  'kategori'));
    }
    function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|unique:kategori',
        ]);


        try {
            $simpan = DB::table('kategori')->insert([
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan,
            ]);
            if ($simpan) {
                return redirect('/kategori')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/kategori')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            //$errorcode = $e->getCode();
            return redirect('/kategori')->with(['failed' => 'Data Gagal Disimpan karena Error !']);
        }
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'kategori' => 'required',
        ]);


        try {
            $simpan = DB::table('kategori')
                ->where('id_kategori', $id)
                ->update([
                    'kategori' => $request->kategori,
                    'keterangan' => $request->keterangan,
                ]);
            if ($simpan) {
                return redirect('/kategori')->with(['success' => 'Data Berhasil Update']);
            } else {
                return redirect('/kategori')->with(['failed' => 'Data Gagal Update']);
            }
        } catch (PDOException $e) {
            //$errorcode = $e->getCode();
            return redirect('/kategori')->with(['failed' => 'Data Gagal Update karena Error !']);
        }
    }


    function delete($id)
    {
        try {
            $hapus = DB::table('kategori')
                ->where('id_kategori', $id)
                ->delete();
            if ($hapus) {
                return redirect('/kategori')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/kategori')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/kategori')->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }
}
