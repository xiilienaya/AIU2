<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HotelTypeModel extends Model
{
    protected $primaryKey='type_id';
    protected $table='hotel-type';
    public $timestamps=false;
}
