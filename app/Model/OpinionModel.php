<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OpinionModel extends Model
{
    protected $primaryKey='op_id';
    protected $table='opinion-table';
    public $timestamps=false;
}
