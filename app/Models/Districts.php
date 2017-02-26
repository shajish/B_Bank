<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    protected $table = 'districts';

    public $timestamps = false;

    protected $fillable = array('name');

    public function userProfiles()
    {
        return $this->hasMany('App\Models\UserProfiles', 'district_id', 'id');
    }
}
