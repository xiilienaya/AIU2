<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlaneModel extends Model
{
    protected $primaryKey='plane_id';
    protected $table='plane-table';
    public $timestamps=false;
}
