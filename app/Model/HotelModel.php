<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HotelModel extends Model
{
    protected $primaryKey='hotel_id';
    protected $table='hotel-table';
    public $timestamps=false;
}
