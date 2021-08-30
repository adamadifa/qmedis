<?php

namespace App\Http\Controllers;

use App\Detailopname;
use App\Opname;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class OpnameController extends Controller
{
    function index(Request $request)
    {
        $title = "Data Stock Opname";
        $query = Produk::query();

        if (!empty($request->cari)) {
            $query = $query->where('nama_produk', 'like', '%' . $request->cari . '%');
        }
        $query->select('produk.*', 'satuan', 'total_stok', 'tgl_opname', 'jam_opname');
        $query->leftjoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori');
        $query->leftjoin('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan');
        $query->leftjoin(
            DB::raw('(SELECT kode_produk,SUM(jml_stok) as total_stok FROM stok_produk  GROUP BY kode_produk )stok'),
            function ($join) {
                $join->on('produk.kode_produk', '=', 'stok.kode_produk');
            }
        );
        $query->leftjoin(
            DB::raw('(SELECT stok_produk.kode_produk,MAX(tgl_opname) as tgl_opname , MAX(jam_opname) as jam_opname
            FROM opname_detail
            INNER JOIN opname ON opname_detail.kode_opname = opname.kode_opname
            INNER JOIN stok_produk ON opname_detail.kode_stok = stok_produk.kode_stok
            GROUP BY stok_produk.kode_produk) opname'),
            function ($join) {
                $join->on('produk.kode_produk', '=', 'opname.kode_produk');
            }
        );
        $query->orderBy('nama_produk', 'asc');
        $produk = $query->paginate(10);
        $produk->appends($request->all());
        return view('opname.index', compact('title', 'produk'));
    }

    function loadpageopname(Request $request)
    {
        $lokasiproduk = DB::table('lokasi_produk')->get();
        $supplier = DB::table('supplier')->get();
        $produk = Produk::where('kode_produk', $request->kode_produk)
            ->join('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan')
            ->first();
        return view('opname.loadpageopname', compact('produk', 'lokasiproduk', 'supplier'));
    }

    function storestok(Request $request)
    {

        $cekstok = DB::table('stok_produk')
            ->select('kode_stok')
            ->orderBy('kode_stok', 'desc')
            ->first();
        if (empty($cekstok->kode_stok)) {
            $kode_stok_terakhir = "ST00000";
        } else {
            $kode_stok_terakhir = $cekstok->kode_stok;
        }
        $kode_stok = buatkode($kode_stok_terakhir, "ST", 5);
        $simpan = DB::table('stok_produk')
            ->insert([
                'kode_stok' => $kode_stok,
                'kode_produk' => $request->kode_produk,
                'id_lokasiproduk' => $request->id_lokasiproduk,
                'kode_supplier' => $request->kode_supplier,
                'tgl_expired' => $request->tgl_expired,
                'kode_batch' => $request->kode_batch
            ]);

        if ($simpan) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function loadstokproduk(Request $request)
    {
        $stokproduk = DB::table('stok_produk')
            ->select('stok_produk.*', 'nama_produk', 'satuan', 'nama_supplier', 'lokasi_produk', 'jml_stok')
            ->leftJoin('produk', 'stok_produk.kode_produk', '=', 'produk.kode_produk')
            ->leftJoin('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan')
            ->leftJoin('supplier', 'stok_produk.kode_supplier', '=', 'supplier.kode_supplier')
            ->leftJoin('lokasi_produk', 'stok_produk.id_lokasiproduk', '=', 'lokasi_produk.id_lokasiproduk')
            ->where('stok_produk.kode_produk', $request->kode_produk)
            ->get();
        return view('opname.loadstokproduk', compact('stokproduk'));
    }

    function updateopname(Request $request)
    {
        $data = $request->all();
        $cekopname = DB::table('opname')
            ->select('kode_opname')
            ->orderBy('kode_opname', 'desc')
            ->first();
        $tglhariini = date("Y-m-d");
        $jamhariini = date("H:i:s");
        $tgl = date('d');
        $bulan = date('m');
        $tahun = substr(date('Y'), 2, 2);
        $format = "OP" . $tgl . $bulan . $tahun;
        if (empty($cekopname->kode_opname)) {
            $kode_opname_terakhir = $format . "0000";
        } else {
            $kode_opname_terakhir = $cekopname->kode_opname;
        }
        $kode_opname = buatkode($kode_opname_terakhir, $format, 4);


        try {
            $simpan = DB::table('opname')->insert([
                'kode_opname' => $kode_opname,
                'tgl_opname' => $tglhariini,
                'jam_opname' => $jamhariini,
                'id_petugas' => Auth::guard('user')->user()->id
            ]);
            if ($simpan) {
                if (count($data['kode_stok']) > 0) {
                    $error = 0;
                    foreach ($data['kode_stok'] as $key => $value) {
                        $simpandetail = DB::table('opname_detail')->insert([
                            'kode_opname' => $kode_opname,
                            'kode_stok' => $data['kode_stok'][$key],
                            'stok_sistem' => $data['stok_sistem'][$key],
                            'stok_fisik' => $data['stok_fisik'][$key],
                            'catatan' => $data['catatan'][$key],
                        ]);

                        if (!$simpandetail) {
                            $error = $error += 1;
                        }
                    }

                    if (empty($error)) {
                        return redirect('/opname')->with(['success' => 'Data Berhasil Disimpan']);
                    } else {
                        return redirect('/opname')->with(['warning' => 'Ada Data Yang Error']);
                    }
                }
            } else {
                return redirect('/opname')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            return redirect('/opname')->with(['failed' => $errorcode]);
        }
    }

    function histori(Request $request)
    {
        $title = "Data Riwayat Stock Opname";
        $query = Detailopname::query();

        if (!empty($request->cari)) {
            $query = $query->where('nama_produk', 'like', '%' . $request->cari . '%');
        }
        $query->select('opname_detail.kode_opname', 'stok_produk.kode_produk', 'nama_produk', 'satuan', 'tgl_opname', 'users.name', DB::raw('SUM(stok_fisik-stok_sistem) AS penyesuaian'));
        $query->join('opname', 'opname_detail.kode_opname', '=', 'opname.kode_opname');
        $query->join('stok_produk', 'opname_detail.kode_stok', '=', 'stok_produk.kode_stok');
        $query->join('produk', 'stok_produk.kode_produk', '=', 'produk.kode_produk');
        $query->join('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan');
        $query->join('users', 'opname.id_petugas', '=', 'users.id');
        $query->groupBy('opname_detail.kode_opname', 'stok_produk.kode_produk', 'tgl_opname', 'nama_produk', 'satuan', 'users.name');
        $query->orderBy('tgl_opname', 'asc');
        $opname = $query->paginate(10);
        $opname->appends($request->all());
        return view('opname.histori', compact('title', 'opname'));
    }

    function detailopname(Request $request)
    {
        $title = "Detail Opname";
        $produk = DB::table('produk')
            ->join('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan')
            ->where('kode_produk', $request->kode_produk)->first();
        $query = Detailopname::query();
        $query->select('lokasi_produk', 'tgl_expired', 'kode_batch', 'stok_sistem', 'stok_fisik', 'catatan');
        $query->join('opname', 'opname_detail.kode_opname', '=', 'opname.kode_opname');
        $query->join('stok_produk', 'opname_detail.kode_stok', '=', 'stok_produk.kode_stok');
        $query->join('lokasi_produk', 'stok_produk.id_lokasiproduk', '=', 'lokasi_produk.id_lokasiproduk');
        $query->join('users', 'opname.id_petugas', '=', 'users.id');
        $query->where('opname_detail.kode_opname', $request->kode_opname);
        $query->orderBy('tgl_opname', 'asc');
        $opname = $query->get();
        return view('opname.loaddetailopname', compact('title', 'opname', 'produk'));
    }

    function delete($kode_opname)
    {
        try {
            $hapus = DB::table('opname')
                ->where('kode_opname', $kode_opname)
                ->delete();
            if ($hapus) {
                return redirect('/histori')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/histori')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/histori')->with(['failed' => 'Data Opname tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }
}
