<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Employee;
use App\Partner;
use App\Partnership;
use App\Province;
use App\Regency;
use App\District;
use App\Outlet;
use App\ServicePrice;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OutletController extends Controller
{
    
    public function showOutletDashboard(){

        if(\Auth::user()->staff_position == 7){
            $outlets = Outlet::where('partner_id', \Auth::user()->partner_id)->get();
        }
        else{
            $outlets = Outlet::all();
        }

    	$provinces = Province::all();
    	$partners = Partner::all();
    	$partnerships = Partnership::all();
    	$rand = array("outlet_id" => "OT".time());
        return view('dashboard.outlet.dashboard', compact('rand', 'outlets', 'provinces', 'partners', 'partnerships'));

    }

    public function inputNewOutlet(Request $request){

    	$outlet = new Outlet();
    	$outlet -> outlet_id = $request -> outlet_id;
    	$outlet -> province = $request -> province;
    	$outlet -> regency = $request -> regency;
    	$outlet -> district = $request -> district;
    	$outlet -> address = $request -> address;
    	$outlet -> telephone_number = $request -> telephone_number;
    	$outlet -> partner_id = $request -> partner_id;
    	$outlet -> partnership_id = $request -> partnership_id;
        $outlet -> total_barber_seat = $request -> total_barber_seat;
        $outlet -> total_reflection_seat = $request -> total_reflection_seat;
    	$outlet -> total_training_seat = $request -> total_training_seat;
    	$outlet -> create_by = \Auth::user()->id;

    	if($outlet -> save()){

            for ($i=0; $i < count($request -> service_id) ; $i++) { 
                $servicePriceAdult = new ServicePrice();
                $servicePriceAdult -> service_id = $request -> service_id[$i];
                $servicePriceAdult -> outlet_id = $outlet -> id;
                $servicePriceAdult -> price = $request -> adult_price[$i];
                $servicePriceAdult -> type = 1;
                $servicePriceAdult -> create_by = \Auth::user()->id;
                $servicePriceAdult -> save();

                $servicePriceKid = new ServicePrice();
                $servicePriceKid -> service_id = $request -> service_id[$i];
                $servicePriceKid -> outlet_id = $outlet -> id;
                $servicePriceKid -> price = $request -> kid_price[$i];
                $servicePriceKid -> type = 2;
                $servicePriceKid -> create_by = \Auth::user()->id;
                $servicePriceKid -> save();
            }

			return redirect()
			->back()
			->with('success', 'New outlet has been saved.');
		}
		else{
			return redirect()
			->back()
			->withErrors([
				'err_msg' => 'Failed to save outlet, please contact administrator.',
			]);
		}

    }

    public function showEditOutlet($id){

    	$outlet = Outlet::findOrFail($id);

        $servicePrices = \DB::table('service_prices')
                        ->selectRaw('service_prices.service_id, services.name, sum(case when service_prices.type=1 then price else 0 end) as adult_price, sum(case when service_prices.type=2 then price else 0 end) as kid_price')
                        ->join('services', 'service_prices.service_id', '=', 'services.id')
                        ->where('service_prices.outlet_id', '=', $id)
                        ->groupBy('service_prices.service_id')
                        ->get();
    	$provinces = Province::all();
    	$regencies = Regency::where('province_id', $outlet->province)->orderBy('name','asc')->get();
    	$districts = District::where('regency_id', $outlet->regency)->orderBy('name','asc')->get();
    	$partners = Partner::all();
    	$partnerships = Partnership::all();
        return view('dashboard.outlet.edit', compact('outlet', 'provinces', 'regencies', 'districts', 'partners', 'partnerships', 'servicePrices'));

    }

    public function editOutlet(Request $request, $id){

    	$outlet = Outlet::findOrFail($id);
    	$outlet -> province = $request -> province;
    	$outlet -> regency = $request -> regency;
    	$outlet -> district = $request -> district;
    	$outlet -> address = $request -> address;
    	$outlet -> telephone_number = $request -> telephone_number;
    	$outlet -> partner_id = $request -> partner_id;
    	$outlet -> partnership_id = $request -> partnership_id;
    	$outlet -> total_barber_seat = $request -> total_barber_seat;
        $outlet -> total_reflection_seat = $request -> total_reflection_seat;
        $outlet -> total_training_seat = $request -> total_training_seat;
    	$outlet -> update_by = \Auth::user()->id;

    	if($outlet -> save()){

            $delPrice = \DB::table('service_prices')->where('outlet_id', $id)->delete(); 

            for ($i=0; $i < count($request -> service_id) ; $i++) { 
                $servicePriceAdult = new ServicePrice();
                $servicePriceAdult -> service_id = $request -> service_id[$i];
                $servicePriceAdult -> outlet_id = $outlet -> id;
                $servicePriceAdult -> price = $request -> adult_price[$i];
                $servicePriceAdult -> type = 1;
                $servicePriceAdult -> create_by = \Auth::user()->id;
                $servicePriceAdult -> save();

                $servicePriceKid = new ServicePrice();
                $servicePriceKid -> service_id = $request -> service_id[$i];
                $servicePriceKid -> outlet_id = $outlet -> id;
                $servicePriceKid -> price = $request -> kid_price[$i];
                $servicePriceKid -> type = 2;
                $servicePriceKid -> create_by = \Auth::user()->id;
                $servicePriceKid -> save();
            }

			return redirect()
			->back()
			->with('success', 'Outlet has been updated.');
		}
		else{
			return redirect()
			->back()
			->withErrors([
				'err_msg' => 'Failed to update outlet, please contact administrator.',
			]);
		}

    }

    public function deleteOutlet($id){

    	$outlet = Outlet::findOrFail($id);
    	$outlet -> delete();

    	if ($outlet->trashed()) {
		    return redirect()
				->back()
				->with('success', 'Outlet Data has been deleted.');
		}
		else{
			return redirect()
				->back()
				->withErrors([
					'err_msg' => 'Failed to delete outlet, please contact administrator.',
				]);
		}

    }

    public function getOutletInfo($id){

        $capsters = Employee::where('staff_position', '8')->where('outlet_id', $id)->selectRaw('id, name')->get();
        $servicePrices = \DB::table('service_prices')
                        ->selectRaw('service_prices.service_id, services.name, sum(case when service_prices.type=1 then price else 0 end) as adult_price, sum(case when service_prices.type=2 then price else 0 end) as kid_price')
                        ->join('services', 'service_prices.service_id', '=', 'services.id')
                        ->where('service_prices.outlet_id', '=', $id)
                        ->groupBy('service_prices.service_id')
                        ->get();

        $outletInfo = array(
            "capsters" => $capsters,
            "prices" => $servicePrices
        );
        
        return $outletInfo;
    }

}