<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Company extends Model
{
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

    protected $fillable = [
        'name', 'slug', 'photo_id', 'needed_car', 'address', 'phone_num', 'remarks'
    ];

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function photoSrc() {
        $photo =  $this->photo;
        return $photo->photo_path;
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function car()
    {
        return $this->hasMany('App\Car');
    }

    public function contract()
    {
        return $this->morphMany('App\Contract', 'contractable');
    }
}
