<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use HasFactory,HasUuids,softDeletes;

    protected  $guarded = [];

    protected  $table = 'mapel';

    public $incrementing = false;
    protected $keyType = 'string';


    protected  $primaryKey = 'id_mapel';

    public function tahun()
    {
        return $this->belongsTo(TahunAkademik::class,'id_tahun');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class,'id_guru');
    }

}
