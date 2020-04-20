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
        $imagePath = ($this->image) ? $this->image : '/images/img_266351.png';
        return '/storage/' . $imagePath;
    }

    public function followers() {
        return $this->belongsToMany('App\User');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
