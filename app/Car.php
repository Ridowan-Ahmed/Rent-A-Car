<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'company_id', 'photo_id', 'registration_num', 'brand_id', 'model_no', 'parking_mode',
        'tax_token_expiry_date','fitness_expiry_date', 'insurance_expiry_date', 'road_permit_expiry_date',
        'driver_name', 'driver_duty', 'driver_nid', 'driver_address', 'driver_phone_num', 'remarks'
    ];
    protected $casts = [
        'tax_token_expiry_date' => 'date',
        'fitness_expiry_date' => 'date',
        'insurance_expiry_date' => 'date',
        'road_permit_expiry_date' => 'date',
    ];

    public function brand() {
        return $this->belongsTo('App\Brand');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function owner() {
        return $this->belongsTo('App\Owner');
    }

    public function company() {
        return $this->belongsTo('App\Company');
    }

    public function photo() {
        return $this->belongsTo('App\Photo');
    }

    public function photoSrc() {
        $photo =  $this->photo;
        return $photo ? $photo->photo_path : null;
    }

    public function logbooks() {
        return $this->hasMany('App\Logbook');
    }

    public function logOfThisMonth() {
        $from = Carbon::now()->startOfMonth();
        $to = Carbon::now()->endOfMonth();
        return $this->logbooks()->whereBetween('log_date', [$from, $to])->get();
    }

    public function logOfPastMonth() {
        $from = new Carbon('first day of last month');
        $to = new Carbon('last day of last month');
        return $this->logbooks()->whereBetween('log_date', [$from, $to])->get();
    }

    public function logOfPastTwoMonth() {
        $from = Carbon::now()->startOfMonth()->modify('-2 months');
        $to = Carbon::now()->endOfMonth()->modify('-2 months');
        return $this->logbooks()->whereBetween('log_date', [$from, $to])->get();
    }
}
