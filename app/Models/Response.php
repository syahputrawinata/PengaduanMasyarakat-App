<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
    'report_id', 
    'user_id', 
    'message'];

    // Relasi: Respons dimiliki oleh laporan
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    // Relasi: Respons dimiliki oleh user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Respons memiliki banyak response_progress
    public function responseProgresses()
    {
        return $this->hasMany(ResponseProgress::class);
    }
}
