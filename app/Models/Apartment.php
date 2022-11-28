<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

const IMAGECOLLECT = 'images';

class Apartment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function city(){
        return $this->belongsTo(city::class , 'city_id' , 'id');
    }

}
