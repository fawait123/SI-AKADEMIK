<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TahunAkademik extends Model
{
    use HasFactory,HasUuids,softDeletes;

    protected  $guarded = [];

    protected  $table = 'tahun_akademik';

    public $incrementing = false;
    protected $keyType = 'string';


    protected  $primaryKey = 'id_tahun';
}
