<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'bio', 'image', 'url',
    ];

    public function profileImage() {
        $imagePath = ($this->image) ? $this->image : 'profile\ZLyumm54iCxqOqdvXKuFRmmAGhZW7cUf9Ha3W49H.png';
        return '/storage/' . $imagePath;
    }

    public function followers() {
        return $this->belongsToMany('App\User');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
