<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'kategori_id',
        'judul',
        'deskripsi',
        'anggaran_min',
        'anggaran_max',
        'deadline',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
