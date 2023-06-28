<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaliKelas extends Model
{
    use HasFactory,HasUuids,softDeletes;
    protected  $guarded = [];

    protected  $table = 'wali_kelas';

    public $incrementing = false;
    protected $keyType = 'string';


    protected  $primaryKey = 'id_wali';

    public function guru()
    {
        return $this->belongsTo(Guru::class,'id_guru');
    }

}
