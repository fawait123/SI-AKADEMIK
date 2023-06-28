<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasSiswa extends Model
{
    use HasFactory,HasUuids,softDeletes;

    protected  $guarded = [];

    protected  $table = 'kelas_siswa';

    public $incrementing = false;
    protected $keyType = 'string';


    protected  $primaryKey = 'id_kelas';


    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'id_siswa');
    }

    public  function tahun()
    {
        return $this->belongsTo(TahunAkademik::class,'id_tahun');
    }
}
