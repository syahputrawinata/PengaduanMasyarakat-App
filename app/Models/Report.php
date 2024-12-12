<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'type',
        'province',
        'regency',
        'subdistrict',
        'village',
        'voting',
        'viewers',
        'image',
        'statement',
    ];

    // Relasi: Laporan dimiliki oleh user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Laporan memiliki banyak komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relasi: Laporan memiliki satu respons
    public function response()
    {
        return $this->hasOne(Response::class);
    }
}
