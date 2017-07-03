<?php namespace App\Models;

/**
 * Eloquent class to describe the events table
 *
 * automatically generated by ModelGenerator.php
 */
class Events extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'events';

    public function getDates()
    {
        return array('date');
    }

    protected $fillable = array('title', 'details', 'location', 'date', 'duration', 'status', 'remark');

    public function users()
    {
        return $this->belongsTo('App\Models\Users', 'user_id', 'id');
    }
}
