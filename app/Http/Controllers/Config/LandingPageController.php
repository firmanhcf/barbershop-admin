<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingPageController extends Controller
{
    
    public function sendMail(Request $request)
    {

        \Mail::send('emails.info', ['data' => $request], function ($message) use ($request) {

            $message->subject('Email from '. $request -> name);
            $message->from($request -> email, $request -> name);
            $message->to('info@bigsmile.id');

            

        });

	    $result = [
        			"status" => "ok",
        			"message" => "Your message has been sent to us, we will contact you as soon as possible"
        			];

	    return json_encode($result);

    }

}