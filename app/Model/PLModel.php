<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PLModel extends Model
{
    protected $primaryKey='pl_id';
    protected $table='pl-table';
    public $timestamps=false;
}
