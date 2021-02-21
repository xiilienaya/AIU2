<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class POrderModel extends Model
{
    protected $primaryKey='po_id';
    protected $table='porder-table';
    public $timestamps=false;
}
