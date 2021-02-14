<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SpotModel extends Model
{
    protected $primaryKey='spot_id';
    protected $table='spot-table';
    public $timestamps=false;
}
