<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerified extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'token',
        'user_id',
        'verified_at'
    ];
}
