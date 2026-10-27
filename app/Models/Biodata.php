<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'biodata_1234';

    protected $fillable = [
        'nama', 'jabatan', 'telepon', 'instagram', 'email',
        'alamat', 'tentang_saya', 'kesukaan', 'foto',
    ];

    public function pengalaman()
    {
        return $this->hasMany(Pengalaman::class, 'biodata_id');
    }

    public function pendidikan()
    {
        return $this->hasMany(Pendidikan::class, 'biodata_id');
    }

    public function keahlian()
    {
        return $this->hasMany(Keahlian::class, 'biodata_id');
}
}
