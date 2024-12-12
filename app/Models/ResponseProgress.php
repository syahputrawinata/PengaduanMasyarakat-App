<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseProgress extends Model
{
    use HasFactory;

    protected $fillable = [
    'response_id', 
    'description', 
    'status', 
    'image'];

    // Relasi: Progress dimiliki oleh respons
    public function response()
    {
        return $this->belongsTo(Response::class);
    }
}
