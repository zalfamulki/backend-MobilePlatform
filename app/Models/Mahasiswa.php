<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function krs_enrollments()
    {
        return $this->hasMany(KrsEnrollment::class);
    }
}
