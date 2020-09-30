<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'octane_cost', 'diesel_cost', 'cng_cost', 'car_rent', 'brand_id', 'num_of_car', 'starting_octane',
        'overtime_cost','breakfast_cost', 'launch_cost', 'dinner_cost', 'contract_type', 'contract_duration', 'remarks'
    ];

    public function car()
    {
        return $this->hasMany('App\Car');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function contractable()
    {
        return $this->morphTo();
    }
}
