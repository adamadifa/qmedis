<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;

class SupplierController extends Controller
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
        $title = "Data Supplier";
        $query = Supplier::query();

        if (!empty($request->cari)) {
            $query = $query->where('nama_supplier', 'like', '%' . $request->cari . '%');
        }
        $query->select('*');
        $query->orderBy('nama_supplier', 'asc');
        $supplier = $query->paginate(10);
        $supplier->appends($request->all());
        return view('supplier.index', compact('title', 'supplier'));
    }

    function create()
    {
        $title = "Input Data Supplier";

        //Cek Dokter Terakhir
        $ceksupplier = DB::table('supplier')
            ->select('kode_supplier')
            ->orderBy('kode_supplier', 'desc')
            ->first();
        if (empty($ceksupplier->kode_supplier)) {
            $kode_supplier_terakhir = "SP000";
        } else {
            $kode_supplier_terakhir = $ceksupplier->kode_supplier;
        }
        $kode_supplier = buatkode($kode_supplier_terakhir, "SP", 3);
        return view('supplier.create', compact('kode_supplier', 'title'));
    }

    function edit($kode_supplier)
    {
        $title = "Edit Data Supplier";
        $supplier = DB::table('supplier')
            ->where('kode_supplier', $kode_supplier)
            ->first();
        return view('supplier.edit', compact('title',  'supplier'));
    }

    function store(Request $request)
    {
        $request->validate([
            'kode_supplier' => 'required|unique:supplier|max:5',
            'nama_supplier' => 'required',
            'no_telepon' => 'numeric'
        ]);


        try {
            $simpan = DB::table('supplier')->insert([
                'kode_supplier' => $request->kode_supplier,
                'nama_supplier' => $request->nama_supplier,
                'alamat_supplier' => $request->alamat_supplier,
                'contact_person' => $request->contact_person,
                'no_telepon' => $request->no_telepon
            ]);
            if ($simpan) {
                return redirect('/supplier')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/supplier')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            //$errorcode = $e->getCode();
            return redirect('/supplier')->with(['failed' => 'Data Gagal Disimpan karena Error !']);
        }
    }

    function update(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'no_telepon' => 'numeric'
        ]);


        try {
            $simpan = DB::table('supplier')
                ->where('kode_supplier', $request->kode_supplier)
                ->update([
                    'nama_supplier' => $request->nama_supplier,
                    'alamat_supplier' => $request->alamat_supplier,
                    'contact_person' => $request->contact_person,
                    'no_telepon' => $request->no_telepon
                ]);
            if ($simpan) {
                return redirect('/supplier')->with(['success' => 'Data Berhasil Disimpan']);
            } else {
                return redirect('/supplier')->with(['failed' => 'Data Gagal Disimpan']);
            }
        } catch (PDOException $e) {
            //$errorcode = $e->getCode();
            return redirect('/supplier')->with(['failed' => 'Data Gagal Disimpan karena Error !']);
        }
    }

    function delete($kode_supplier)
    {
        try {
            $hapus = DB::table('supplier')
                ->where('kode_supplier', $kode_supplier)
                ->delete();
            if ($hapus) {
                return redirect('/supplier')->with(['success' => 'Data Berhasil di hapus']);
            } else {
                return redirect('/supplier')->with(['success' => 'Data Gagal di hapus']);
            }
        } catch (PDOException $e) {
            $errorcode = $e->getCode();
            if ($errorcode == 23000) {
                return redirect('/supplier')->with(['failed' => 'Data Pendaftaran tidak dapat dihapus karena memiliki histori transaksi !']);
            }
        }
    }
}
