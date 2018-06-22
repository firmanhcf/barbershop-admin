<?php

namespace App\Http\Controllers\Config;

use App\Province;
use App\Regency;
use App\District;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    
    public function getRegency($region)
    {
    	$regencies = Regency::where('province_id',$region)->orderBy('name', 'asc')->get();
    	return $regencies;
    }

    public function getDistrict($regency)
    {
    	$district = District::where('regency_id',$regency)->orderBy('name', 'asc')->get();
    	return $district;
    }

}