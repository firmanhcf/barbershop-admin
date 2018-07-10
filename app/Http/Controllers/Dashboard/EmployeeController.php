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

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function showEmployeeDashboard()
    {
    	$provinces = Province::all();
    	$outlets = Outlet::all();
    	$employees = Employee::whereIn('staff_position', ['1','2','3','4','5','6'])->get();
    	$capsters = Employee::whereIn('staff_position', ['8', '9', '10'])->get();
    	$now = Carbon::today();
    	$rand = array("emp_id" => "EMP".$now->year."".substr("".time(), (strlen("".time())-6), 6));
    	$pos=config('app.employee_position');
        return view('dashboard.employee.dashboard', compact('provinces', 'outlets', 'employees', 'capsters','rand', 'pos'));

    }

    public function inputNewEmployee(Request $request)
    {
    
    	$idCardFile = $request -> file('id_card_files');
        $filename = $idCardFile -> getClientOriginalName();
        $extension = $idCardFile -> getClientOriginalExtension();
        $idCard = sha1($filename . time()) . '.' . $extension;
        $destinationPath = public_path() . '/assets/idcard/';
    	$request->file('id_card_files')->move($destinationPath, $idCard);

    	$certificateFile = $request -> file('last_education_certificate');
        $filename = $certificateFile -> getClientOriginalName();
        $extension = $certificateFile -> getClientOriginalExtension();
        $certificate = sha1($filename . time()) . '.' . $extension;
        $destinationPath = public_path() . '/assets/certificate/';
    	$request->file('last_education_certificate')->move($destinationPath, $certificate);	

    	$newEmployee = new Employee();
    	$newEmployee -> nik = $request -> nik;
    	$newEmployee -> name = $request -> name;
    	$newEmployee -> province = $request -> province;
    	$newEmployee -> regency = $request -> regency;
    	$newEmployee -> district = $request -> district;
    	$newEmployee -> address = $request -> address;
    	$newEmployee -> religion = $request -> religion;
    	$newEmployee -> id_card_number = $request -> id_card_number;
    	$newEmployee -> id_card_files = $idCard;
    	$newEmployee -> last_education = $request -> last_education;
    	$newEmployee -> last_education_certificate = $certificate;
    	$newEmployee -> email = $request -> email;
    	$newEmployee -> salary = $request -> salary;
    	$newEmployee -> account_status = 1;
    	$newEmployee -> staff_status = $request -> staff_status;
    	$newEmployee -> staff_position = $request -> staff_position;
    	$newEmployee -> outlet_id = $request -> outlet_id;
    	$newEmployee -> password = bcrypt($request -> password);
    	$newEmployee -> birthdate = \DateTime::createFromFormat('d/m/Y', $request -> birthdate);
    	$newEmployee -> create_by = \Auth::user()->id;

    	if($newEmployee -> save()){

    		$pksFile = $request -> file('pks_file');
            $filename = $pksFile -> getClientOriginalName();
            $extension = $pksFile -> getClientOriginalExtension();
            $pksPdf = sha1($filename . time()) . '.' . $extension;
            $destinationPath = public_path() . '/assets/pks/employee/';
        	$request->file('pks_file')->move($destinationPath, $pksPdf);

			$newEmployeePKS = new UserPks();
			$newEmployeePKS -> user_id = $newEmployee -> id;
			$newEmployeePKS -> pks_number = $request -> pks_number;
			$newEmployeePKS -> pks_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_date);
			$newEmployeePKS -> pks_start_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_start_date);
			$newEmployeePKS -> pks_end_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_end_date);
            $newEmployeePKS -> pks_file = $pksPdf;
            $newEmployeePKS -> create_by = \Auth::user()->id;

			if($newEmployeePKS -> save()){

                // \Mail::send('emails.login', ['name' => $request -> name, 'email' => $request -> email, 'password' => $request -> password], function ($message) use ($request) {

                //     $message->subject('User Login Information');
                //     $message->from('no-reply@bigsmile.id', 'Big Smile');
                //     $message->to('sampahbebas@gmail.com');

                // });

				return redirect()
				->back()
				->with('success', 'Data Karyawan telah berhasil disimpan.');
			}
			else{
				return redirect()
				->back()
				->withErrors([
					'err_msg' => 'Gagal menyimpan PKS, hubungi administrator untuk info lebih lanjut.',
				]);
			}

    	}
    	else{
    		return redirect()
				->back()
				->withErrors([
					'err_msg' => 'Gagal menyimpan data karyawan, hubungi administrator untuk info lebih lanjut.',
				]);
    	}

    }

    public function deleteEmployee($id)
    {
    	$employee = Employee::findOrFail($id);
    	$employee -> delete();

    	if ($employee->trashed()) {
		    return redirect()
				->back()
				->with('success', 'Data karyawan telah dihapus.');
		}
		else{
			return redirect()
				->back()
				->withErrors([
					'err_msg' => 'Gagal menghapus data karyawan, hubungi administrator untuk info lebih lanjut.',
				]);
		}
    	
    }

    public function showEditEmployee($id)
    {

    	$employee = Employee::findOrFail($id);
    	$employee->birthdate = Carbon::parse($employee->birthdate)->format('d/m/Y');

    	$provinces = Province::all();
    	$regencies = Regency::where('province_id', $employee->province)->get();
    	$districts = District::where('regency_id', $employee->regency)->get();
    	$outlets = Outlet::all();
    	
    	$pos = config('app.employee_position');

    	$pksList = UserPks::where('user_id', $id)->orderBy('created_at', 'asc')->get();
    	$pks = $pksList->first();
    	$pks->pks_date = Carbon::parse($pks->pks_date)->format('d/m/Y');
    	$pks->pks_start_date = Carbon::parse($pks->pks_start_date)->format('d/m/Y');
    	$pks->pks_end_date = Carbon::parse($pks->pks_end_date)->format('d/m/Y');

        return view('dashboard.employee.edit', compact('provinces', 'outlets', 'employee', 'pos', 'pks', 'regencies', 'districts'));

    }

    public function editEmployee(Request $request, $id)
    {
    	$employee = Employee::findOrFail($id);
    	$employee -> nik = $request -> nik;
    	$employee -> name = $request -> name;
    	$employee -> province = $request -> province;
    	$employee -> regency = $request -> regency;
    	$employee -> district = $request -> district;
    	$employee -> address = $request -> address;
    	$employee -> religion = $request -> religion;
    	$employee -> id_card_number = $request -> id_card_number;
    	$employee -> last_education = $request -> last_education;
    	$employee -> salary = $request -> salary;
    	$employee -> account_status = 1;
    	$employee -> staff_status = $request -> staff_status;
    	$employee -> staff_position = $request -> staff_position;
    	$employee -> outlet_id = $request -> outlet_id;
    	$employee -> birthdate = \DateTime::createFromFormat('d/m/Y', $request -> birthdate);
    	$employee -> create_by = \Auth::user()->id;

    	if ($request->hasFile('id_card_files')) {
    		$idCardFile = $request -> file('id_card_files');
	        $filename = $idCardFile -> getClientOriginalName();
	        $extension = $idCardFile -> getClientOriginalExtension();
	        $idCard = sha1($filename . time()) . '.' . $extension;
	        $destinationPath = public_path() . '/assets/idcard/';
	    	$request->file('id_card_files')->move($destinationPath, $idCard);
	    	$employee -> id_card_files = $idCard;
    	
    	}

    	if ($request->hasFile('last_education_certificate')) {

	    	$certificateFile = $request -> file('last_education_certificate');
	        $filename = $certificateFile -> getClientOriginalName();
	        $extension = $certificateFile -> getClientOriginalExtension();
	        $certificate = sha1($filename . time()) . '.' . $extension;
	        $destinationPath = public_path() . '/assets/certificate/';
	    	$request->file('last_education_certificate')->move($destinationPath, $certificate);	
	    	$employee -> last_education_certificate = $certificate;

    	}

    	if($employee -> save()){

    		$pksList = UserPks::where('user_id', $id)->orderBy('created_at', 'asc')->get();
    		$pks = $pksList->first();
    		$pks -> pks_number = $request -> pks_number;
			$pks -> pks_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_date);
			$pks -> pks_start_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_start_date);
			$pks -> pks_end_date = \DateTime::createFromFormat('d/m/Y', $request -> pks_end_date);
			$pks -> update_by = \Auth::user()->id;

			if ($request->hasFile('pks_file')) {
			    $pksFile = $request -> file('pks_file');
	            $filename = $pksFile -> getClientOriginalName();
	            $extension = $pksFile -> getClientOriginalExtension();
	            $pksPdf = sha1($filename . time()) . '.' . $extension;
	            $destinationPath = public_path() . '/assets/pks/employee/';
            	$request->file('pks_file')->move($destinationPath, $pksPdf);
            	$pks -> pks_file = $pksPdf;
			}

			if($pks -> save()){

				return redirect()
				->back()
				->with('success', 'Data karyawan berhasil diupdate.');
			}
			else{
				return redirect()
                ->back()
                ->withErrors([
                    'err_msg' => 'Gagal menyimpan PKS, hubungi administrator untuk info lebih lanjut.',
                ]);
			}

    	}
    	else{
    		return redirect()
                ->back()
                ->withErrors([
                    'err_msg' => 'Gagal menyimpan data karyawan, hubungi administrator untuk info lebih lanjut.',
                ]);
    	}
    }

}