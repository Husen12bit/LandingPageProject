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
<<<<<<< Updated upstream
=======

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
>>>>>>> Stashed changes
}
