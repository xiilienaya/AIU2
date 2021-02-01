<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FansModel extends Model
{
    protected $primaryKey='fs_id';
    protected $table='fans-table';
    public $timestamps=false;
}
