<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai', function (Blueprint $table) {
            $table->string('id_nilai')->primary()->unique();
            $table->string('id_siswa');
            $table->string('nama_kelas');
            $table->string('id_mapel');
            $table->string('id_tahun');
            $table->string('uh1');
            $table->string('uh2');
            $table->string('uh3');
            $table->string('uts');
            $table->string('uas');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
