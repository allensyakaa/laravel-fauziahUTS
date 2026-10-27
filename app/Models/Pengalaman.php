<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
   protected $table = 'pengalaman';
    protected $fillable = ['biodata_id', 'periode', 'posisi', 'deskripsi'];
}
