<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $primaryKey='county_id';
    protected $table='county-table';
    public $timestamps=false;
}
