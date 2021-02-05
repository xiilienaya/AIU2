<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $primaryKey='id';
    protected $table='city-county';
    public $timestamps=false;
}
