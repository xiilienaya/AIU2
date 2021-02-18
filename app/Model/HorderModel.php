<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HorderModel extends Model
{
    protected $primaryKey='horder_id';
    protected $table='horder-table';
    public $timestamps=false;
}
