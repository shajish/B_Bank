<?php namespace App\Models;

/**
 * Eloquent class to describe the role_users table
 *
 * automatically generated by ModelGenerator.php
 */
class RoleUsers extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'role_users';

    public $timestamps = false;

    protected $fillable = array('role');

    public function users()
    {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }
}