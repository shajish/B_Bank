<?php namespace App\Models;

/**
 * Eloquent class to describe the districts table
 *
 * automatically generated by ModelGenerator.php
 */
class Districts extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'districts';

    public $timestamps = false;

    protected $fillable = array('name');

    public function userProfiles()
    {
        return $this->hasMany('App\Models\UserProfiles', 'address1', 'id');
    }
}
