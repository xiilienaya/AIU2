<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class YouJiModel extends Model
{
    protected $primaryKey='yj_id';
    protected $table='youji-table';
    public $timestamps=false;
}
