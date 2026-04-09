<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

    protected $table = 'freelancers';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'no_telepon',
        'keahlian',
        'portfolio',
        'deskripsi',
        'harga_per_hari',
        'pengalaman_tahun',
        'rating',
        'status'
    ];
}
