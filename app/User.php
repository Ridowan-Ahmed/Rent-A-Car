<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;
    use SluggableScopeHelpers;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo_id', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function cars() {
        return $this->hasManyThrough('App\Car', 'App\Owner');
    }

    public function owners()
    {
        return $this->hasMany('App\Owner');
    }

    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    public function photoSrc() {
        $photo =  $this->photo;
        if (isset($photo))
            return $photo->photo_path;
        else
            return $this->getGravatarAttribute();
    }

    public function getGravatarAttribute() {
        $hash = md5(strtolower(trim($this->attributes['email']))) . "?d=mm";
        return "https://en.gravatar.com/avatar/$hash";
    }
}
