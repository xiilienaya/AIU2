<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HotelPlModel extends Model
{
    protected $primaryKey='hpl_id';
    protected $table='hotel-pl';
    public $timestamps=false;
}
