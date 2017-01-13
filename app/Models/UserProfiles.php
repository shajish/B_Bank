<?php namespace App\Models;

/**
 * Eloquent class to describe the user_profiles table
 *
 * automatically generated by ModelGenerator.php
 */
class UserProfiles extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'user_profiles';

    public $primaryKey = 'email';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = array('name', 'location', 'contacts');

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }

}

