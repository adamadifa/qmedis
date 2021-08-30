<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('npp', 10);
            $table->primary('npp');
            $table->string('nama_lengkap', 100);
            $table->string('nama_panggilan', 50);
            $table->char('jenis_kelamin', 1);
            $table->string('tempat_lahir', 15);
            $table->string('no_ktp', 16);
            $table->date('no_kk', 16);
            $table->string('no_hp', 13);
            $table->string('whatsapp', 13);
            $table->string('instagram', 20);
            $table->string('facebook', 20);
            $table->string('status', 15);
            $table->string('alamat_ktp', 100);
            $table->string('rt', 100);
            $table->string('rw', 100);
            $table->integer('id_kelurahan');
            $table->integer('id_kecamatan');
            $table->integer('id_kota');
            $table->string('tmt', 10);
            $table->char('status_kepegawaian', 1);
            $table->integer('id_jabatan');
            $table->integer('id_unit');
            $table->string('nama_ayah', 100);
            $table->string('nama_ibu', 100);
            $table->string('alamat_orangtua', 100);
            $table->string('nama_pasangan', 100);
            $table->string('tempat_lahir_pasangan', 25);
            $table->date('tanggal_lahir_pasangan');
            $table->string('pendidikan_terakhir', 3);
            $table->string('pekerjaan', 25);
            $table->string('kontak', 13);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawan');
    }
}
