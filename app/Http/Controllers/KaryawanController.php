<?php

namespace App\Http\Controllers;

use App\Dokumenkaryawan;
use App\Jabatan;
use App\Karyawan;
use App\Propinsi;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{

    function index()
    {

        $tanggalhariini = Carbon::now();
        $datakaryawan = Karyawan::orderBy('nama_lengkap', 'asc')->paginate(15);
        return view('karyawan.index', compact('datakaryawan', 'tanggalhariini'));
    }

    function create()
    {
        $unit = Unit::all();
        $jabatan = Jabatan::all();
        $propinsi = Propinsi::orderBy('prov_name', 'asc')->get();
        return view('karyawan.create', compact('propinsi', 'unit', 'jabatan'));
    }

    function store(Request $request)
    {
        $attribute = $request->validate([
            'npp' => 'required|max:10|unique:karyawan',
            'nama_lengkap' => 'required',
            'nama_panggilan' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_ktp' => 'required',
            'no_kk' => 'required',
            'no_hp' => 'required',
            'whatsapp' => 'required',
            'instagram' => 'required',
            'facebook' => 'required',
            'alamat_ktp' => 'required',
            'alamat_tinggal' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'status' => 'required',
            'id_propinsi' => 'required',
            'id_kota' => 'required',
            'id_kecamatan' => 'required',
            'id_kelurahan' => 'required',
            'tmt' => 'required',
            'masa_kerja' => 'required',
            'status_kepegawaian' => 'required',
            'id_jabatan' => 'required',
            'id_unit' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_orangtua' => 'required',
            'kontak' => 'required',

        ]);

        Karyawan::create($attribute);
    }

    function edit($npp)
    {
        $unit = Unit::all();
        $jabatan = Jabatan::all();
        $propinsi = Propinsi::orderBy('id', 'asc')->get();
        $karyawan = Karyawan::findorfail($npp);
        return view('karyawan.edit', compact('karyawan', 'unit', 'jabatan', 'propinsi'));
    }


    function update(Request $request, $npp)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nama_panggilan' => 'required',
            //'jenis_kelamin' => 'required',
            //'tempat_lahir' => 'required',
            //'tanggal_lahir' => 'required',
            //'golongan_darah' => 'required',
            //'no_ktp' => 'required',
            //'no_kk' => 'required',
            //'no_hp' => 'required',
            //'whatsapp' => 'required',
            //'instagram' => 'required',
            //'facebook' => 'required',
            //'alamat_ktp' => 'required',
            //'alamat_tinggal' => 'required',
            //'rt' => 'required',
            //'rw' => 'required',
            //'status' => 'required',
            //'id_propinsi' => 'required',
            //'id_kota' => 'required',
            //'id_kecamatan' => 'required',
            //'id_kelurahan' => 'required',
            //'tmt' => 'required',

            //'status_kepegawaian' => 'required',
            //'id_jabatan' => 'required',
            //'id_unit' => 'required',
            //'nama_ayah' => 'required',
            //'nama_ibu' => 'required',
            //'alamat_orangtua' => 'required',

        ]);

        $karyawan = Karyawan::find($npp);
        $karyawan->nama_lengkap = $request->nama_lengkap;
        $karyawan->nama_panggilan  = $request->nama_panggilan;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->tempat_lahir = $request->tempat_lahir;
        $karyawan->tanggal_lahir = $request->tanggal_lahir;
        $karyawan->golongan_darah = $request->golongan_darah;
        $karyawan->no_ktp = $request->no_ktp;
        $karyawan->no_kk = $request->no_kk;
        $karyawan->no_hp = $request->no_hp;
        $karyawan->whatsapp =  $request->whatsapp;
        $karyawan->instagram = $request->instagram;
        $karyawan->facebook = $request->facebook;
        $karyawan->alamat_ktp = $request->alamat_ktp;
        $karyawan->alamat_tinggal = $request->alamat_tinggal;
        $karyawan->rt = $request->rt;
        $karyawan->rw = $request->rw;
        $karyawan->status = $request->status;
        $karyawan->id_propinsi = $request->id_propinsi;
        $karyawan->id_kota = $request->id_kota;
        $karyawan->id_kecamatan = $request->id_kecamatan;
        $karyawan->id_kelurahan = $request->id_kelurahan;
        $karyawan->tmt = $request->tmt;
        $karyawan->masa_kerja = $request->masa_kerja;
        $karyawan->status_kepegawaian = $request->status_kepegawaian;
        $karyawan->id_jabatan = $request->id_jabatan;
        $karyawan->id_unit = $request->id_unit;
        $karyawan->nama_ayah = $request->nama_ayah;
        $karyawan->nama_ibu = $request->nama_ibu;
        $karyawan->nama_pasangan = $request->nama_pasangan;
        $karyawan->tempat_lahir_pasangan = $request->tempat_lahir_pasangan;
        $karyawan->tanggal_lahir_pasangan = $request->tanggal_lahir_pasangan;
        $karyawan->pendidikan_terakhir = $request->pendidikan_terakhir;
        $karyawan->pekerjaan = $request->pekerjaan;
        $karyawan->kontak = $request->kontak;
        $karyawan->alamat_orangtua = $request->alamat_orangtua;
        $karyawan->save();
        return redirect('/karyawan/' . $npp)->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($npp)
    {
        $karyawan = DB::table('karyawan')
            ->leftjoin('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id')
            ->leftjoin('unit', 'karyawan.id_unit', '=', 'unit.id')
            ->leftjoin('provinces', 'karyawan.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'karyawan.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'karyawan.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'karyawan.id_kelurahan', '=', 'villages.id')
            ->Where('npp', '=', $npp)
            ->first();
        $unit = Unit::all();
        //dd($karyawan);
        return view('karyawan.show', compact('karyawan', 'unit'));
    }

    public function uploaddokumen($npp)
    {
        $karyawan = DB::table('karyawan')
            ->leftjoin('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id')
            ->leftjoin('unit', 'karyawan.id_unit', '=', 'unit.id')
            ->leftjoin('provinces', 'karyawan.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'karyawan.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'karyawan.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'karyawan.id_kelurahan', '=', 'villages.id')
            ->Where('npp', '=', $npp)
            ->first();

        $dokumen = Dokumenkaryawan::find($npp);
        //dd($dokumen);
        return view('karyawan.uploaddokumen', compact('karyawan', 'dokumen'));
    }

    public function storedokumen(Request $request, $npp)
    {
        //dd($request->ktp);
        $request->validate([
            'ktp' => 'mimes:pdf|max:1024',
            'kk' => 'mimes:pdf|max:1024',
            'ijazah' => 'mimes:pdf|max:1024',

        ]);
        if ($request->ktp) {
            $ktp =   "KTP-" . $npp . "." . $request->ktp->extension();
            $request->file('ktp')->storeAs('public/dokumen', $ktp);
            //$request->ktp->move(public_path('dokumen'), $ktp);
        } else {
            $ktp = "";
        }

        if ($request->kk) {
            $kk =   "KK-" . $npp . "." . $request->kk->extension();
            $request->file('kk')->storeAs('public/dokumen', $kk);
            //$request->kk->move(public_path('dokumen'), $kk);
        } else {
            $kk = "";
        }

        if ($request->ijazah) {
            $ijazah =   "IJ-" . $npp . "." . $request->ijazah->extension();
            $request->file('ijazah')->storeAs('public/dokumen', $ijazah);
            //$request->ijazah->move(public_path('dokumen'), $ijazah);
        } else {
            $ijazah = "";
        }

        $cekdokumen = Dokumenkaryawan::find($npp);
        $dok = $cekdokumen->first();
        if ($cekdokumen->count() > 0) {
            if (empty($ktp)) {
                $ktp = $dok->ktp;
            }

            if (empty($kk)) {
                $kk = $dok->kk;
            }

            if (empty($ijazah)) {
                $ijazah = $dok->ijazah;
            }

            Dokumenkaryawan::find($npp)->update([
                'ktp' => $ktp,
                'kk' => $kk,
                'ijazah' => $ijazah,
            ]);
        } else {
            Dokumenkaryawan::create([
                'npp' => $npp,
                'ktp' => $ktp,
                'kk' => $kk,
                'ijazah' => $ijazah,
            ]);
        }

        return redirect('/karyawan/' . $npp . '/uploaddokumen')->with(['success' => 'Data Berhasil Disimpan']);;
    }

    public function gantifoto($npp)
    {
        $karyawan = DB::table('karyawan')
            ->leftjoin('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id')
            ->leftjoin('unit', 'karyawan.id_unit', '=', 'unit.id')
            ->leftjoin('provinces', 'karyawan.id_propinsi', '=', 'provinces.id')
            ->leftjoin('regencies', 'karyawan.id_kota', '=', 'regencies.id')
            ->leftjoin('districts', 'karyawan.id_kecamatan', '=', 'districts.id')
            ->leftjoin('villages', 'karyawan.id_kelurahan', '=', 'villages.id')
            ->Where('npp', '=', $npp)
            ->first();
        return view('karyawan.gantifoto', compact('karyawan'));
    }


    public function updatefoto(Request $request, $npp)
    {
        $request->validate([
            'foto' => 'required|mimes:jpg,jpeg,png|max:1024',
        ]);
        if ($request->foto) {
            $foto =   "FT-" . $npp . "." . $request->foto->extension();
            $request->file('foto')->storeAs('public/foto', $foto);
            //$request->foto->move(public_path('foto'), $foto);
        } else {
            $foto = "";
        }


        Karyawan::find($npp)->update([
            'foto' => $foto,
        ]);


        return redirect('/karyawan/' . $npp . '/gantifoto')->with(['success' => 'Data Berhasil Disimpan']);;
    }

    function getunittambahan(Request $request)
    {
        $unittambahan = DB::table('unit_tambahan')
            ->leftjoin('unit', 'unit_tambahan.id_unit', '=', 'unit.id')
            ->where('npp', '=', $request->npp)
            ->get();
        return view('karyawan.unit_tambahan', compact('unittambahan'));
    }

    function storeunittambahan(Request $request)
    {
        DB::table('unit_tambahan')->insert(['npp' => $request->npp, 'id_unit' => $request->unittambahan]);
    }

    function destroyunittambahan(Request $request)
    {
        DB::table('unit_tambahan')
            ->where('npp', $request->npp)
            ->where('id_unit', $request->id_unit)
            ->delete();
    }

    function storeanak(Request $request)
    {
        DB::table('keluarga')->insert(['npp' => $request->npp, 'nama_anak' => $request->nama_anak, 'tgl_lahir_anak' => $request->tgl_lahir_anak, 'jk_anak' => $request->jk_anak, 'anak_ke' => $request->anak_ke]);
    }

    function getanak(Request $request)
    {
        $anak = DB::table('keluarga')
            ->where('npp', '=', $request->npp)
            ->get();
        return view('karyawan.anak', compact('anak'));
    }

    function destroyanak(Request $request)
    {
        DB::table('keluarga')
            ->where('id', $request->id)
            ->delete();
    }

    function storependidikan(Request $request)
    {
        DB::table('riwayat_pendidikan')->insert(['npp' => $request->npp, 'tingkat' => $request->tingkat, 'nama_sekolah' => $request->nama_sekolah, 'tahunlulus' => $request->tahunlulus]);
    }

    function getpendidikan(Request $request)
    {
        $pendidikan = DB::table('riwayat_pendidikan')
            ->where('npp', '=', $request->npp)
            ->get();
        return view('karyawan.pendidikan', compact('pendidikan'));
    }

    function destroypendidikan(Request $request)
    {
        DB::table('riwayat_pendidikan')
            ->where('id', $request->id)
            ->delete();
    }

    function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $datakaryawan = DB::table('karyawan')
            ->where('nama_lengkap', 'like', "%" . $cari . "%")
            ->orWhere('npp', $cari)
            ->paginate(15);
        $datakaryawan->appends($request->all());

        // mengirim data pegawai ke view index
        return view('karyawan.index', compact('datakaryawan'));
    }

    function destroy($npp)
    {
        $destroy = DB::table('karyawan')->where('npp', $npp)->delete();
        if ($destroy) {
            return redirect('/karyawan/')->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return redirect('/karyawan/')->with(['failed' => 'Data Gagal Dihapus']);
        }
    }
}
