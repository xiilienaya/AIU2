<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $primaryKey='user_id';
    protected $table='user-table';
    public $timestamps=false;
}
