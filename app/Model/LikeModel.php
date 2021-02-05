<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LikeModel extends Model
{
    protected $primaryKey='like_id';
    protected $table='like-table';
    public $timestamps=false;
}
