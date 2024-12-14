<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id', 
    'report_id', 
    'comment',
    ];

    // Relasi: Komentar dimiliki oleh user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Komentar dimiliki oleh laporan
    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
