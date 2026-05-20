<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'project_id',
        'payment_type',
        'status',
        'amount',
        'midtrans_payload',
    ];

    protected $casts = [
        'midtrans_payload' => 'array',
        'amount' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
