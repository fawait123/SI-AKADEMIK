<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sesi extends Model
{
    use HasFactory,HasUuids,softDeletes;

    protected  $guarded = [];

    protected  $table = 'sesi';

    public $incrementing = false;
    protected $keyType = 'string';


    protected  $primaryKey = 'id_sesi';

    public function mapel()
    {
        return $this->belongsTo(Mapel::class,'id_mapel');
    }
}
