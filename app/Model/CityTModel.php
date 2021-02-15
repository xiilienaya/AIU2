<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CityTModel extends Model
{
    protected $primaryKey='city_id';
    protected $table='city-table';
    public $timestamps=false;
}
