<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoControl extends Model
{
    use HasFactory;
    protected $table = 'photos';
    protected $guarded = false;
    protected $connection = 'mysql';
    protected $fillable = [
        'title',
        'body',
    ];
}
