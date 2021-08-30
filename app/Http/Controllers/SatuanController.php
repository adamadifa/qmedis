<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class SatuanController extends Controller
{
    function index(Request $request)
    {
        $title = "Data Satuan";
        $satuan = DB::table('satuan')->get();
        return view('satuan.index', compact('title', 'satuan'));
    }

    function create()
    {
        $title = "Input Data Satuan";
        return view('satuan.create', compact('title'));
    }

    function edit($id)
    {
        $title = "Edit Data Satuan";
        $satuan = DB::table('satuan')
            ->where('id_satuan', $id)
            ->first();
        return view('satuan.edit', compact('title',  'satuan'));
    }

    function store(Request $request)
    {
        $request->validate([
            'satuan' => 'required|unique:satuan',
        ]);


        try {
            $simpan = DB::table('satuan')->insert([
                'satuan' => $request->satuan,
            ]);
            if ($simpan) {
                return redirect('/satuan')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/satuan')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            //$errorcode = $e->getCode();
            return redirect('/satuan')->with(['failed' => 'Data Gagal Disimpan karena Error !']);
        }
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'satuan' => 'required',
        ]);


        try {
            $simpan = DB::table('satuan')
                ->where('id_satuan', $id)
                ->update([
                    'satuan' => $request->satuan,

                ]);
            if ($simpan) {
                return redirect('/satuan')->with(['success' => 'Data Berhasil Update']);
            } else {
                return redirect('/satuan')->with(['failed' => 'Data Gagal Update']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            return redirect('/satuan')->with(['failed' => $errorcode]);
        }
    }


    function delete($id)
    {
        try {
            $hapus = DB::table('satuan')
                ->where('id_satuan', $id)
                ->delete();
            if ($hapus) {
                return redirect('/satuan')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/satuan')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/satuan')->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }
}
