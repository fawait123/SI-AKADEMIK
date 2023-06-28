<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use HasFactory,softDeletes, HasUuids;

    protected  $guarded = [];

    protected  $table = 'guru';

    public $incrementing = false;
    protected $keyType = 'string';


    protected  $primaryKey = 'id_guru';

}
