<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $primaryKey='country_id';
    protected $table='country-table';
    public $timestamps=false;
}
