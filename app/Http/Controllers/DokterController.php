<?php

namespace App\Http\Controllers;

use App\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDOException;

class DokterController extends Controller
{
    function index(Request $request)
    {
        $title = "Data Dokter";
        $query = Dokter::query();

        if (!empty($request->cari)) {
            $query = $query->where('nama_dokter', 'like', '%' . $request->cari . '%');
        }
        $query->select('*');
        $query->orderBy('kode_dokter', 'asc');
        $dokter = $query->paginate(10);
        $dokter->appends($request->all());
        return view('dokter.index', compact('title', 'dokter'));
    }

    function create()
    {
        $title = "Input Data Dokter";
        $propinsi = DB::table('provinces')->orderBy('prov_name', 'asc')->get();
        $spesialis = DB::table('spesialis')->orderBy('id_spesialis', 'asc')->get();
        //Cek Dokter Terakhir
        $cekdokter = DB::table('dokter')
            ->select('kode_dokter')
            ->orderBy('kode_dokter', 'desc')
            ->first();
        if (empty($cekdokter->kode_dokter)) {
            $kode_dokter_terakhir = "D000";
        } else {
            $kode_dokter_terakhir = $cekdokter->kode_dokter;
        }
        $kode_dokter = buatkode($kode_dokter_terakhir, "D", 3);
        return view('dokter.create', compact('propinsi', 'spesialis', 'kode_dokter', 'title'));
    }

    function edit($kode_dokter)
    {
        $title = 'Edit Data Dokter';
        $propinsi = DB::table('provinces')->orderBy('prov_name', 'asc')->get();
        $spesialis = DB::table('spesialis')->orderBy('id_spesialis', 'asc')->get();
        $dokter = DB::table('dokter')
            ->where('kode_dokter', $kode_dokter)
            ->first();

        return view('dokter.edit', compact('title', 'dokter', 'propinsi', 'spesialis'));
    }

    function show($kode_dokter)
    {
        $title = 'Profil Dokter';
        $dokter = DB::table('dokter')
            ->leftjoin('spesialis', 'dokter.id_spesialis', '=', 'spesialis.id_spesialis')
            ->leftjoin('provinces', 'dokter.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'dokter.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'dokter.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'dokter.id_kelurahan', '=', 'villages.id')
            ->where('kode_dokter', $kode_dokter)
            ->first();


        return view('dokter.show', compact('title', 'dokter'));
    }

    function store(Request $request)
    {
        $request->validate([
            'kode_dokter' => 'required|unique:dokter|max:4',
            'nik' => 'max:16',
            'nama_dokter' => 'required',
            'id_spesialis' => 'required',
            'no_telepon' => 'required',
        ]);


        try {
            $simpan = DB::table('dokter')->insert([
                'kode_dokter' => $request->kode_dokter,
                'nik' => $request->nik,
                'nama_dokter' => $request->nama_dokter,
                'no_str' => $request->no_str,
                'id_spesialis' => $request->id_spesialis,
                'alamat' => $request->alamat,
                'id_propinsi' => $request->id_propinsi,
                'id_kota' => $request->id_kota,
                'id_kecamatan' => $request->id_kecamatan,
                'id_kelurahan' => $request->id_kelurahan,
                'no_telepon' => $request->no_telepon,
                'tgl_mulai_tugas' => $request->tgl_mulai_tugas,
                'password' =>  Hash::make($request->kode_dokter)
            ]);
            if ($simpan) {
                return redirect('/dokter')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/dokter')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            //$errorcode = $e->getCode();
            return redirect('/dokter')->with(['failed' => 'Data Gagal Disimpan karena Error !']);
        }
    }


    function update(Request $request)
    {
        $request->validate([
            'nik' => 'max:16',
            'nama_dokter' => 'required',
            'id_spesialis' => 'required',
            'no_telepon' => 'required',
        ]);


        try {
            $simpan = DB::table('dokter')
                ->where('kode_dokter', $request->kode_dokter)
                ->update([
                    'nik' => $request->nik,
                    'nama_dokter' => $request->nama_dokter,
                    'no_str' => $request->no_str,
                    'id_spesialis' => $request->id_spesialis,
                    'alamat' => $request->alamat,
                    'id_propinsi' => $request->id_propinsi,
                    'id_kota' => $request->id_kota,
                    'id_kecamatan' => $request->id_kecamatan,
                    'id_kelurahan' => $request->id_kelurahan,
                    'no_telepon' => $request->no_telepon,
                    'tgl_mulai_tugas' => $request->tgl_mulai_tugas,
                ]);
            if ($simpan) {
                return redirect('/dokter')->with(['success' => 'Data Berhasil Update']);
            } else {
                return redirect('/dokter')->with(['failed' => 'Data Gagal Update']);
            }
        } catch (PDOException $e) {
            //$errorcode = $e->getCode();
            return redirect('/dokter')->with(['failed' => 'Data Gagal Update karena Error !']);
        }
    }


    function delete($kode_dokter)
    {
        try {
            $hapus = DB::table('dokter')
                ->where('kode_dokter', $kode_dokter)
                ->delete();
            if ($hapus) {
                return redirect('/dokter')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/dokter')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/dokter')->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }
}
