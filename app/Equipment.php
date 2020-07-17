<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{

    protected $table = 'equipments';

    public $guarded = ['id'];

    public function realEstate()
    {
        return $this->belongsToMany('App\RealEstate');
    }
}
