<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Apartment extends Model implements HasMedia
{
    const COLLECTIONNAME = 'images';
    use HasFactory, InteractsWithMedia;
    protected $guarded = [];
    protected $connection = 'mysql';
    protected $table = 'apartments';
    public function city(){
        return $this->belongsTo(city::class , 'city_id' , 'id');
    }

}
