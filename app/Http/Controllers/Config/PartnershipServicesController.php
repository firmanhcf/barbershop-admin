<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;

class PartnershipServicesController extends Controller
{
    
    public function getServices($partnership)
    {
        /*
            SELECT partnership_services.partnership_id, partnership_services.service_id, services.name
            FROM partnership_services
            INNER JOIN services ON partnership_services.service_id=services.id  WHERE partnership_services.partnership_id=2
        */
    	$services = \DB::table('partnership_services')
                    ->join('services', 'partnership_services.service_id', '=', 'services.id')
                    ->where('partnership_services.partnership_id', '=', $partnership)
                    ->select('partnership_services.partnership_id', 'partnership_services.service_id', 'services.name')
                    ->get();
    	return $services;
    }


}