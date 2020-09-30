<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $fillable = [
        'octane_starting_km','octane_ending_km','diesel_starting_km','diesel_ending_km','cng_starting_km','cng_ending_km',
        'log_date', 'starting_time', 'ending_time', 'payment_amount', 'payment_type', 'payment_reason'];

    public function car()
    {
        return $this->belongsTo('App\Car');
    }
}
