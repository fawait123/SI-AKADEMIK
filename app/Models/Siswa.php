<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use HasFactory,SoftDeletes,HasUuids;

    protected  $guarded = [];

    protected  $table = 'siswa';

    public $incrementing = false;
    protected $keyType = 'string';


    protected  $primaryKey = 'id_siswa';

    public function kelas()
    {
        return $this->hasMany(KelasSiswa::class,'id_siswa');
    }
}
