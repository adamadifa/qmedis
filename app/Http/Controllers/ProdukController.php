<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDOException;

class ProdukController extends Controller
{
    function index(Request $request)
    {

        // $str = '';
        // $str .= "<div style='width:200px;'>";
        // $str .= '<span>34435345</span>';
        // $str .= \DNS1D::getBarcodeHTML("4445645656", "I25+");
        // $str .= '<span size="1">Parfum Bau Bangke</span>';
        // $str .= '</div>';

        // echo $str;
        //die;
        $title = "Data Produk";
        $query = Produk::query();

        if (!empty($request->cari)) {
            $query = $query->where('nama_produk', 'like', '%' . $request->cari . '%');
        }
        $query->select('*');
        $query->leftjoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori');
        $query->leftjoin('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan');
        $query->orderBy('nama_produk', 'asc');
        $produk = $query->paginate(10);
        $produk->appends($request->all());
        return view('produk.index', compact('title', 'produk'));
    }

    function create()
    {
        $title = "Input Data Produk";
        $kategori = DB::table('kategori')->get();
        $satuan = DB::table('satuan')->get();
        //Cek Dokter Terakhir
        $cekproduk = DB::table('produk')
            ->select('kode_produk')
            ->orderBy('kode_produk', 'desc')
            ->first();
        if (empty($cekproduk->kode_produk)) {
            $kode_produk_terakhir = "PRD0000";
        } else {
            $kode_produk_terakhir = $cekproduk->kode_produk;
        }
        $kode_produk = buatkode($kode_produk_terakhir, "PRD", 4);
        return view('produk.create', compact('kode_produk', 'title', 'kategori', 'satuan'));
    }



    function edit($kode_produk)
    {
        $title = "Edit Data Produk";
        $kategori = DB::table('kategori')->get();
        $satuan = DB::table('satuan')->get();
        $produk = DB::table('produk')
            ->leftjoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
            ->leftjoin('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan')
            ->where('kode_produk', $kode_produk)
            ->first();
        return view('produk.edit', compact('title', 'kategori', 'satuan', 'produk'));
    }

    function show($kode_produk)
    {
        $title = 'Detail Produk';
        $produk = DB::table('produk')
            ->leftjoin('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
            ->leftjoin('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan')
            ->where('kode_produk', $kode_produk)
            ->first();
        return view('produk.show', compact('title', 'produk'));
    }

    function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produk|max:7',
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'min_stock' => 'required',
            'harga_beli' => 'required|numeric'
        ]);


        try {
            $simpan = DB::table('produk')->insert([
                'kode_produk' => $request->kode_produk,
                'nama_produk' => $request->nama_produk,
                'id_kategori' => $request->id_kategori,
                'id_satuan' => $request->id_satuan,
                'min_stock' => $request->min_stock,
                'deskripsi' => $request->deskripsi,
                'harga_beli' => str_replace(".", "", $request->harga_beli),
                'barcode' => $request->barcode
            ]);
            if ($simpan) {
                return redirect('/produk')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/produk')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            //$errorcode = $e->getCode();
            return redirect('/produk')->with(['failed' => 'Data Gagal Disimpan karena Error !']);
        }
    }

    function update(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'min_stock' => 'required',
            'harga_beli' => 'required|numeric'
        ]);


        try {
            $simpan = DB::table('produk')
                ->where('kode_produk', $request->kode_produk)
                ->update([
                    'kode_produk' => $request->kode_produk,
                    'nama_produk' => $request->nama_produk,
                    'id_kategori' => $request->id_kategori,
                    'id_satuan' => $request->id_satuan,
                    'min_stock' => $request->min_stock,
                    'deskripsi' => $request->deskripsi,
                    'harga_beli' => str_replace(".", "", $request->harga_beli),
                    'barcode' => $request->barcode
                ]);
            if ($simpan) {
                return redirect('/produk')->with(['success' => 'Data Berhasil Diupdate']);
            } else {
                return redirect('/produk')->with(['failed' => 'Data Gagal Diupdate']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getMessage();
            //echo $errorcode;
            return redirect('/produk')->with(['failed' => 'Data Gagal Diupdate karena Error !']);
        }
    }

    function delete($kode_produk)
    {
        try {
            $hapus = DB::table('produk')
                ->where('kode_produk', $kode_produk)
                ->delete();
            if ($hapus) {
                return redirect('/produk')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/produk')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/produk')->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }

    public function autocomplete(Request $request)
    {
        $hasil = Produk::select("nama_produk")
            ->where("nama_produk", "LIKE", "%{$request->get('query')}%")
            ->get();
        $data = array();
        foreach ($hasil as $hsl) {
            $data[] = $hsl->nama_produk;
        }
        return response()->json($data);
    }

    public function getautocomplete(Request $request)
    {

        $search = $request->search;

        if ($search == '') {
            $autocomplate = Produk::orderby('nama_produk', 'asc')->select('kode_produk', 'nama_produk')->limit(5)->get();
        } else {
            $autocomplate = Produk::orderby('nama_produk', 'asc')->select('kode_produk', 'nama_produk')->where('nama_produk', 'like', '%' . $search . '%')->limit(5)->get();
        }


        //dd($autocomplate);
        $response = array();
        foreach ($autocomplate as $autocomplate) {
            $response[] = array("value" => $autocomplate->nama_produk, "label" => $autocomplate->nama_produk, 'val' => $autocomplate->kode_produk);
        }

        echo json_encode($response);
        exit;
    }
}
