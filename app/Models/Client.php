<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'nama_perusahaan',
        'nama_kontak',
        'email',
        'no_telepon',
        'alamat',
        'bidang_usaha',
        'total_proyek',
        'status'
    ];
}
