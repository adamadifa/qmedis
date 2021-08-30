<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Auth.login');
});
Route::get('/phpinfo', function () {
    phpinfo();
});
Route::get('/login', function () {
    return view('Auth.login');
})->name('login');
Route::get('/daftar', function () {
    return view('Auth.register');
})->name('daftar');
Route::post('/postlogin', 'LoginController@postlogin')->name('postlogin');
Route::post('/postregister', 'LoginController@postregister')->name('postregister');
Route::get('/logout', 'LoginController@postlogout')->name('logout');

Route::middleware(['auth:user', 'ceklevel:admin'])->group(function () {
    Route::get('/dokter', 'DokterController@index');
    Route::get('dokter/create', 'DokterController@create');
    Route::post('dokter/store', 'DokterController@store');
    Route::post('dokter/update', 'DokterController@update');
    Route::get('dokter/{kode_dokter}/show', 'DokterController@show');
    Route::get('dokter/{kode_dokter}/edit', 'DokterController@edit');
    Route::delete('dokter/{kode_dokter}/delete', 'DokterController@delete');

    //Produk
    Route::get('/produk', 'ProdukController@index');
    Route::get('/produk/create', 'ProdukController@create');
    Route::post('/produk/store', 'ProdukController@store');
    Route::post('/produk/update', 'ProdukController@update');
    Route::get('/produk/{kode_produk}/show', 'ProdukController@show');
    Route::get('/produk/{kode_produk}/edit', 'ProdukController@edit');
    Route::delete('/produk/{kode_produk}/delete', 'ProdukController@delete');

    //Supplier
    Route::get('/supplier', 'SupplierController@index');
    Route::get('/supplier/create', 'SupplierController@create');
    Route::get('/supplier/{kode_supplier}/edit', 'SupplierController@edit');
    Route::post('/supplier/store', 'SupplierController@store');
    Route::post('/supplier/update', 'SupplierController@update');
    Route::delete('/supplier/{kode_supplier}/delete', 'SupplierController@delete');

    //Kategori
    Route::get('/kategori', 'KategoriController@index');
    Route::get('/kategori/create', 'KategoriController@create');
    Route::get('/kategori/{id}/edit', 'KategoriController@edit');
    Route::post('/kategori/{id}/update', 'KategoriController@update');
    Route::delete('/kategori/{id}/delete', 'KategoriController@delete');
    Route::post('/kategori/store', 'KategoriController@store');

    //Satuan
    Route::get('/satuan', 'SatuanController@index');
    Route::get('/satuan/create', 'SatuanController@create');
    Route::post('/satuan/store', 'SatuanController@store');
    Route::get('/satuan/{id}/edit', 'SatuanController@edit');
    Route::post('/satuan/{id}/update', 'SatuanController@update');
    Route::delete('/satuan/{id}/delete', 'SatuanController@delete');


    //Apotek
    Route::get('/apotek', 'ApotekController@index');
    Route::get('/apotek/create', 'ApotekController@create');
    Route::post('/apotek/store', 'ApotekController@store');
    Route::get('/apotek/{id}/edit', 'ApotekController@edit');
    Route::post('/apotek/update', 'ApotekController@update');
    Route::get('/apotek/{id}/show', 'ApotekController@show');
    Route::delete('/apotek/{id}/delete', 'ApotekController@delete');

    //Persentase Laba
    Route::get('/persentaselaba', 'PersentaselabaController@index');
    Route::get('/persentaselaba/create', 'PersentaselabaController@create');
    Route::post('/persentaselaba/store', 'PersentaselabaController@store');
    Route::get('/persentaselaba/{id}/edit', 'PersentaselabaController@edit');
    Route::post('/persentaselaba/{id}/update', 'PersentaselabaController@update');
    Route::delete('/persentaselaba/{id}/delete', 'PersentaselabaController@delete');

    //Lokasi Produk
    Route::get('/lokasiproduk', 'LokasiprodukController@index');
    Route::get('/lokasiproduk/create', 'LokasiprodukController@create');
    Route::post('/lokasiproduk/store', 'LokasiprodukController@store');
    Route::get('/lokasiproduk/{id}/edit', 'LokasiprodukController@edit');
    Route::post('/lokasiproduk/{id}/update', 'LokasiprodukController@update');
    Route::delete('/lokasiproduk/{id}/delete', 'LokasiprodukController@delete');

    //Opname
    Route::get('/opname', 'OpnameController@index');
    Route::post('/opname/loadpageopname', 'OpnameController@loadpageopname');
    Route::post('/opname/storestok', 'OpnameController@storestok');
    Route::post('/opname/loadstokproduk', 'OpnameController@loadstokproduk');
    Route::post('/opname/updateopname', 'OpnameController@updateopname');
    Route::post('/opname/detailopname', 'OpnameController@detailopname');
    Route::delete('/opname/{kode_opname}/delete', 'OpnameController@delete');
    Route::get('/histori', 'OpnameController@histori');



    //Penjualan
    Route::get('/penjualan/create', 'PenjualanController@create');
    Route::post('/penjualan/storeproduktemp', 'PenjualanController@storeproduktemp');
    Route::post('/getproduktemp', 'PenjualanController@getproduktemp');
    Route::post('/updateqty', 'PenjualanController@updateqty');
    Route::post('/updatediskon', 'PenjualanController@updatediskon');
    Route::post('/deleteproduktemp', 'PenjualanController@deleteproduktemp');
    Route::post('/loadtotalpenjualan', 'PenjualanController@loadtotalpenjualan');
    Route::post('/updatepersentaselaba', 'PenjualanController@updatepersentaselaba');
    Route::post('/penjualan/store', 'PenjualanController@store');
    Route::get('/penjualan', 'PenjualanController@index');
    Route::get('/penjualan/{no_faktur}/{jenisstruk}/cetakstruk', 'PenjualanController@cetakstruk');


    //Laporan
    Route::get('/laporan/penjualan', 'LaporanController@penjualan');
    Route::post('/laporan/cetakpenjualan', 'LaporanController@cetakpenjualan');

    //AutoComplete
    Route::get('/autocompleteproduk', 'ProdukController@autocomplete')->name('autocompleteproduk');
    Route::post('/getautocompleteproduk', 'ProdukController@getautocomplete')->name('getautocompleteproduk');


    Route::get('cekversi', function () {
        $laravel = app();
        return "Versi laravelmu adalah " . $laravel::VERSION;
    });
    Route::get('/dashboard', 'DashboardController@index');
});

Route::middleware(['auth:karyawan', 'ceklevel:user'])->group(function () {
});


Route::middleware(['auth:user,karyawan', 'ceklevel:admin,user'])->group(function () {
    //get Kelurahan s/d Provinsi
    Route::post('/kota/getkota', 'KotaController@getkota');
    Route::post('/kecamatan/getkecamatan', 'KecamatanController@getkecamatan');
    Route::post('/kelurahan/getkelurahan', 'KelurahanController@getkelurahan');
});
