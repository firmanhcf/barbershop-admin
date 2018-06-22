<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Employee;

class AccountController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showAccount()
    {
        if(empty(\Auth::user()->outlet_id)){
            $employees = Employee::all();
        }
        else{
            $employees = Employee::where('outlet_id', \Auth::user()->outlet_id)->get();
        }

    	
    	$pos=config('app.employee_position');
        return view('admin.account.dashboard', compact('employees', 'pos'));
    }

    public function accountActivation($id, $status)
    {
    	$statusStr = "";
    	if($status == 1){
    		$statusStr = "Activated";
    	}
    	else{
    		$statusStr = "Deactivated";
    	}
    	
        $employee = Employee::findOrFail($id);
        $employee ->  account_status = $status;

        if($employee -> save()){
        	return redirect()
			->back()
			->with('success', 'Account has been '.$statusStr.'.');
        }
        else{
        	return redirect()
			->back()
			->withErrors([
				'err_msg' => 'Failed to update account, please contact administrator.',
			]);
        }
    }
}