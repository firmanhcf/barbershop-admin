<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Partner;
use App\User;
use App\PartnerPKS;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PartnerController extends Controller
{
    
    public function showPartnerDashboard(){

    	$partners = Partner::all();
    	$rand = array("partner_id" => "BGS".time());
        return view('dashboard.partner.dashboard', compact('rand', 'partners'));

    }

    public function inputNewPartner(Request $request){

    	$newPartner = new Partner();
    	$newPartner -> partner_id = $request -> partner_id;
    	$newPartner -> owner_name = $request -> name;
    	$newPartner -> owner_address = $request -> address;
    	$newPartner -> owner_id_card_number = $request -> id_card_number;
    	$newPartner -> create_by = \Auth::user()->id;

    	if($newPartner -> save()){

    		$newUser = new User();
    		$newUser -> nik = $request -> partner_id;
    		$newUser -> email = $request -> email;
    		$newUser -> password = bcrypt($request -> password);
    		$newUser -> account_status = '1';
            $newUser -> name = $request -> name;
            $newUser -> staff_status = 3;
    		$newUser -> staff_position = 7;
    		$newUser -> address = $request -> address;
            $newUser -> id_card_number = $request -> id_card_number;
    		$newUser -> partner_id = $newPartner -> id;
    		$newUser -> create_by = \Auth::user()->id;

    		if($newUser -> save()){

    			$pksFile = $request -> file('pks_file');
	            $filename = $pksFile -> getClientOriginalName();
	            $extension = $pksFile -> getClientOriginalExtension();
	            $pksPdf = sha1($filename . time()) . '.' . $extension;
	            $destinationPath = public_path() . '/assets/pks/partner/';
            	$request->file('pks_file')->move($destinationPath, $pksPdf);

    			$newPartnerPKS = new PartnerPKS();
    			$newPartnerPKS -> partner_id = $newPartner -> id;
    			$newPartnerPKS -> pks_number = $request -> pks_number;
    			$newPartnerPKS -> pks_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_date);
    			$newPartnerPKS -> pks_start_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_start_date);
    			$newPartnerPKS -> pks_end_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_end_date);
    			$newPartnerPKS -> investation = $request -> investation;
	            $newPartnerPKS -> pks_file = $pksPdf;
	            $newPartnerPKS -> create_by = \Auth::user()->id;

    			if($newPartnerPKS -> save()){

    				return redirect()
					->back()
					->with('success', 'New Partner has been saved.');
    			}
    			else{
    				return redirect()
					->back()
					->withErrors([
						'err_msg' => 'Failed to save PKS for new partner, please contact administrator.',
					]);
    			}


    		}
    		else{
    			return redirect()
				->back()
				->withErrors([
					'err_msg' => 'Failed to create user for new partner, please contact administrator.',
				]);
    		}
    	}
    	else{
    		return redirect()
			->back()
			->withErrors([
				'err_msg' => 'Failed to save new partner, please contact administrator.',
			]);
    	}
    	
    }

    public function showEditPartner($id){
    	
    	$partner = Partner::findOrFail($id);

    	$pksList = PartnerPKS::where('partner_id', $id)->orderBy('created_at', 'asc')->get();
    	$pks = $pksList->first();
    	$pks->pks_date = Carbon::parse($pks->pks_date)->format('d/m/Y');
    	$pks->pks_start_date = Carbon::parse($pks->pks_start_date)->format('d/m/Y');
    	$pks->pks_end_date = Carbon::parse($pks->pks_end_date)->format('d/m/Y');

    	$userList = User::where('nik', $partner->partner_id)->get();
    	$user = $userList->first();

    	return view('dashboard.partner.edit', compact('partner', 'pks', 'user'));

    }

    public function editPartner(Request $request, $id){
    	
    	$partner = Partner::findOrFail($id);
    	$partner -> owner_name = $request -> name;
    	$partner -> owner_address = $request -> address;
    	$partner -> owner_id_card_number = $request -> id_card_number;
    	$partner -> update_by = \Auth::user()->id;

    	if($partner->save()){

    		$pksList = PartnerPKS::where('partner_id', $id)->orderBy('created_at', 'asc')->get();
    		$pks = $pksList->first();
    		$pks -> pks_number = $request -> pks_number;
			$pks -> pks_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_date);
			$pks -> pks_start_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_start_date);
			$pks -> pks_end_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_end_date);
			$pks -> investation = $request -> investation;
			$pks -> update_by = \Auth::user()->id;

			if ($request->hasFile('pks_file')) {
			    $pksFile = $request -> file('pks_file');
	            $filename = $pksFile -> getClientOriginalName();
	            $extension = $pksFile -> getClientOriginalExtension();
	            $pksPdf = sha1($filename . time()) . '.' . $extension;
	            $destinationPath = public_path() . '/assets/pks/partner/';
            	$request->file('pks_file')->move($destinationPath, $pksPdf);
            	$pks -> pks_file = $pksPdf;
			}

			if($pks -> save()){

				return redirect()
				->back()
				->with('success', 'Partner Data has been updated.');
			}
			else{
				return redirect()
				->back()
				->withErrors([
					'err_msg' => 'Failed to save PKS for new partner, please contact administrator.',
				]);
			}

    	}
    	else{
    		return redirect()
			->back()
			->withErrors([
				'err_msg' => 'Failed to save new partner, please contact administrator.',
			]);
    	}

    }

    public function deletePartner($id){

    	$partner = Partner::findOrFail($id);
    	$partner -> delete();

    	if ($partner->trashed()) {
		    return redirect()
				->back()
				->with('success', 'Partner Data has been deleted.');
		}
		else{
			return redirect()
				->back()
				->withErrors([
					'err_msg' => 'Failed to delete partner, please contact administrator.',
				]);
		}

    }

}