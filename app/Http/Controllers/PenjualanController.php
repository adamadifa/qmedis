<?php

namespace App\Http\Controllers;

use App\Penjualan;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class PenjualanController extends Controller
{

    function index(Request $request)
    {
        $query = Penjualan::query();

        if (!empty($request->dari) && !empty($request->sampai)) {
            $query = $query->whereBetween('tgl_transaksi', [$request->dari, $request->sampai]);
        }

        if (!empty($request->kode_apotek)) {
            $query = $query->where('penjualan.kode_apotek', $request->kode_apotek);
        }
        $query->select('penjualan.*', 'nama_customer', 'nama_apotek', 'sia_no', 'name', 'total_harga');
        $query->leftjoin('customer', 'penjualan.id_customer', '=', 'customer.id_customer');
        $query->leftjoin('apotek', 'penjualan.kode_apotek', '=', 'apotek.kode_apotek');
        $query->leftjoin('users', 'penjualan.id_petugas', '=', 'users.id');
        $query->leftjoin(
            DB::raw('(SELECT no_faktur,ROUND(SUM(   (harga_beli + ((persentase_laba/100)*harga_beli)) * qty     )) - ROUND(SUM( (diskon/100) * ((harga_beli + ((persentase_laba/100)*harga_beli)) * qty)   )) AS total_harga
            FROM penjualan_detail
            GROUP BY no_faktur
            ) detail'),
            function ($join) {
                $join->on('penjualan.no_faktur', '=', 'detail.no_faktur');
            }
        );
        $query->orderBy('no_faktur', 'desc');
        $penjualan = $query->paginate(10);
        $penjualan->appends($request->all());
        $apotek = DB::table('apotek')->get();
        $title = "Data Penjualan";
        return view('penjualan.index', compact('title', 'penjualan', 'apotek'));
    }
    function create()
    {
        $lokasiproduk = DB::table('lokasi_produk')->get();
        $persentase_laba = DB::table('persentase_laba')->get();
        $apotek = DB::table('apotek')->get();
        $title = "Input Data penjualan";
        return view('penjualan.create', compact('title', 'persentase_laba', 'lokasiproduk', 'apotek'));
    }

    function store(Request $request)
    {
        //Cek Dokter Terakhir
        $kode_apotek = $request->kode_apotek;
        $hariini = date('Y-m-d');
        $jamsekarang = date("H:i:s");
        $tanggal = str_replace("-", "", $hariini);
        $cekpenjualan = DB::table('penjualan')
            ->select('no_faktur')
            ->where('tgl_transaksi', $hariini)
            ->where('kode_apotek', $kode_apotek)
            ->orderBy('no_faktur', 'desc')
            ->first();
        if (empty($cekpenjualan->no_faktur)) {
            $no_faktur_terakhir = $kode_apotek . $tanggal . "000";
        } else {
            $no_faktur_terakhir = $cekpenjualan->no_faktur;
        }
        $no_faktur = buatkode($no_faktur_terakhir, $kode_apotek . $tanggal, 3);

        if (empty($request->id_customer)) {
            $id_customer = "C001";
        } else {
            $id_customer = $request->id_customer;
        }
        $simpan = DB::table('penjualan')->insert([
            'no_faktur' => $no_faktur,
            'tgl_transaksi' => $hariini,
            'jam_transaksi' => $jamsekarang,
            'id_customer' => $id_customer,
            'diskon' => $request->diskonfaktur,
            'ppn' => $request->ppn,
            'kode_apotek' => $request->kode_apotek,
            'jumlah_tunai' => str_replace(".", "", $request->jumlah_tunai),
            'id_petugas' => Auth::guard('user')->user()->id
        ]);
        if ($simpan) {
            $temp = DB::table('penjualan_detail_temp')
                ->where('id_user', Auth::guard('user')->user()->id)
                ->get();
            $error = 0;
            foreach ($temp as $d) {
                $simpandetail = DB::table('penjualan_detail')
                    ->insert([
                        'no_faktur' => $no_faktur,
                        'kode_produk' => $d->kode_produk,
                        'harga_beli' => $d->harga_beli,
                        'qty' => $d->qty,
                        'diskon' => $d->diskon,
                        'persentase_laba' => $d->persentase_laba,
                        'kode_stok' => $d->kode_stok
                    ]);
                if (!$simpandetail) {
                    $error += 1;
                }
            }

            if ($error > 0) {
                DB::table('penjualan_detail')
                    ->where('no_faktur', $no_faktur)
                    ->delete();

                DB::table('penjualan')
                    ->where('no_faktur', $no_faktur)
                    ->delete();
                return redirect('/penjualan/create')->with(['failed' => 'Data Gagal Disimpan']);
            } else {
                DB::table('penjualan_detail_temp')
                    ->where('id_user', Auth::guard('user')->user()->id)
                    ->delete();
                if ($request->struk == "76mm") {
                    return redirect('/penjualan/' . $no_faktur . '/76mm/cetakstruk')->with(['success' => 'Data Berhasil Disimpan']);
                } else {
                    return redirect('/penjualan/' . $no_faktur . '/a5/cetakstruk')->with(['success' => 'Data Berhasil Disimpan']);
                }
            }
        }
    }

    function storeproduktemp(Request $request)
    {
        $cekproduk = DB::table('penjualan_detail_temp')
            ->where('kode_produk', $request->kode_produk)
            ->where('id_user', Auth::guard('user')->user()->id)
            ->first();
        $cekstok = DB::table('stok_produk')
            ->where('kode_produk', $request->kode_produk)
            ->where('id_lokasiproduk', $request->id_lokasiproduk)
            ->orderBy('tgl_expired', 'asc')
            ->orderBy('updated_at', 'asc')
            ->first();
        if (empty($cekstok->jml_stok)) {
            echo "0";
        } else {
            if (empty($cekproduk->kode_produk)) {
                $produk = Produk::where('kode_produk', $request->kode_produk)->first();
                $simpan = DB::table('penjualan_detail_temp')->insert([
                    'kode_produk' => $request->kode_produk,
                    'harga_beli' => $produk->harga_beli,
                    'qty' => 1,
                    'diskon' => 0,
                    'persentase_laba' => $request->persentase_laba,
                    'kode_stok' => $cekstok->kode_stok,
                    'id_user' => Auth::guard('user')->user()->id
                ]);
            } else {
                echo "2";
            }
        }
    }

    function getproduktemp(Request $request)
    {
        $produktemp = DB::table('penjualan_detail_temp')
            ->join('produk', 'penjualan_detail_temp.kode_produk', '=', 'produk.kode_produk')
            ->join('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan')
            ->get();

        return view('penjualan.loadproduktemp', compact('produktemp'));
    }

    function updateqty(Request $request)
    {
        $update = DB::table('penjualan_detail_temp')
            ->where('kode_produk', $request->kode_produk)
            ->where('id_user', Auth::guard('user')->user()->id)
            ->update([
                'qty' => $request->qty
            ]);

        if ($update) {
            echo 1;
        } else {
            echo 2;
        }
    }


    function updatediskon(Request $request)
    {
        $update = DB::table('penjualan_detail_temp')
            ->where('kode_produk', $request->kode_produk)
            ->where('id_user', Auth::guard('user')->user()->id)
            ->update([
                'diskon' => $request->diskon
            ]);

        if ($update) {
            echo 1;
        } else {
            echo 2;
        }
    }



    function deleteproduktemp(Request $request)
    {
        DB::table('penjualan_detail_temp')
            ->where('kode_produk', $request->kode_produk)
            ->where('id_user', Auth::guard('user')->user()->id)
            ->delete();
    }

    function loadtotalpenjualan()
    {
        $penjualan_temp = DB::table('penjualan_detail_temp')
            ->select(DB::raw('ROUND(SUM(   (harga_beli + ((persentase_laba/100)*harga_beli)) * qty     )) - ROUND(SUM( (diskon/100) * ((harga_beli + ((persentase_laba/100)*harga_beli)) * qty)   )) AS total_harga  '))
            ->where('id_user', Auth::guard('user')->user()->id)
            ->first();
        echo number_format($penjualan_temp->total_harga, '0', '', '.');
    }

    function updatepersentaselaba(Request $request)
    {
        DB::table('penjualan_detail_temp')
            ->where('id_user', Auth::guard('user')->user()->id)
            ->update([
                'persentase_laba' => $request->persentase_laba
            ]);
    }

    function cetakstruk($no_faktur, $jenisstruk)
    {
        $query = Penjualan::query();

        // if (!empty($request->cari)) {
        //     $query = $query->where('nama_produk', 'like', '%' . $request->cari . '%');
        // }
        $query->select(
            'penjualan.*',
            'nama_customer',
            'nama_apotek',
            'sia_no',
            'name',
            'total_harga',
            'apotek.alamat as alamat_apotek',
            'apotek.no_telepon as telepon_apotek',
            'customer.no_telepon as telepon_customer',
            'customer.alamat as alamat_customer'
        );
        $query->leftjoin('customer', 'penjualan.id_customer', '=', 'customer.id_customer');
        $query->leftjoin('apotek', 'penjualan.kode_apotek', '=', 'apotek.kode_apotek');
        $query->leftjoin('users', 'penjualan.id_petugas', '=', 'users.id');
        $query->leftjoin(
            DB::raw('(SELECT no_faktur,ROUND(SUM(   (harga_beli + ((persentase_laba/100)*harga_beli)) * qty     )) - ROUND(SUM( (diskon/100) * ((harga_beli + ((persentase_laba/100)*harga_beli)) * qty)   )) AS total_harga
            FROM penjualan_detail
            GROUP BY no_faktur
            ) detail'),
            function ($join) {
                $join->on('penjualan.no_faktur', '=', 'detail.no_faktur');
            }
        );
        $query->where('penjualan.no_faktur', $no_faktur);
        $query->orderBy('no_faktur', 'desc');
        $penjualan = $query->first();

        $detailpenjualan = DB::table('penjualan_detail')
            ->leftJoin('produk', 'penjualan_detail.kode_produk', '=', 'produk.kode_produk')
            ->leftJoin('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan')
            ->leftJoin('stok_produk', 'penjualan_detail.kode_stok', '=', 'stok_produk.kode_stok')
            ->where('no_faktur', $no_faktur)
            ->get();
        if ($jenisstruk == "76mm") {

            return view('penjualan.struk.kecil_76mm', compact('penjualan', 'detailpenjualan'));
        } else if ($jenisstruk == "a5") {
            return view('penjualan.struk.a5', compact('penjualan', 'detailpenjualan'));
        }
    }
}
