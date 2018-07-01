<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Employee;
use App\UserPks;
use App\Province;
use App\Regency;
use App\District;
use App\Outlet;
use Carbon\Carbon;

class ProfileController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showProfile()
    {
    	$employee = Employee::findOrFail(\Auth::user()->id);
    	$employee->birthdate = Carbon::parse($employee->birthdate)->format('d/m/Y');

    	$provinces = Province::all();
    	$regencies = Regency::where('province_id', $employee->province)->get();
    	$districts = District::where('regency_id', $employee->regency)->get();
    	$outlets = Outlet::all();
    	
    	$pos = config('app.employee_position');

        return view('dashboard.profile.dashboard', compact('provinces', 'outlets', 'employee', 'pos', 'regencies', 'districts'));
    }

    public function changePassword(Request $request)
    {
        if (!(\Hash::check($request->get('current_password'), \Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Passwrod lama tidak cocok. Silakan coba lagi.");
        }
 
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Passwaord baru harus berbeda dengan password lama. Silakan masukkan password yang berbeda.");
        }
 
        //Change Password
        $user = \Auth::user();
        $user->password = bcrypt($request -> new_password);
        $user->save();
 
        return redirect()->back()->with("success","Password telah diubah.");
    }

    public function changeProfilePhoto(Request $request){

    	$employee = Employee::findOrFail(\Auth::user()->id);

    	if ($request->hasFile('profile_photo')) {

    		$idCardFile = $request -> file('profile_photo');
	        $filename = $idCardFile -> getClientOriginalName();
	        $extension = $idCardFile -> getClientOriginalExtension();
	        $idCard = sha1($filename . time()) . '.' . $extension;
	        $destinationPath = public_path() . '/assets/profilephoto/';
	    	$request->file('profile_photo')->move($destinationPath, $idCard);
	    	$employee -> photo = $idCard;
    	
    	}

    	if($employee -> save()){
    		return redirect()
				->back()
				->with('success', 'Foto profil telah diubah.');
    	}
    	else{
    		return redirect()
				->back()
				->withErrors([
					'err_msg' => 'Gagal uplod foto profil, hubungi administrator untuk info lebih lanjut.',
				]);
    	}

    }

}