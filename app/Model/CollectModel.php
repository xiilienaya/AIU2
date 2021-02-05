<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CollectModel extends Model
{
    protected $primaryKey='sc_id';
    protected $table='collect-table';
    public $timestamps=false;
}
