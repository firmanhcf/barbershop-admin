<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\Customer;
use App\Employee;
use App\TransactionDetail;
use App\Outlet;
use Carbon\Carbon;

class TransactionController extends Controller
{
    
    public function showTransactionDashboard()
    {
    	
    	$now = Carbon::today();
    	$rand = array(
    		"invoice_num" => "BGS/INV-".$now->day."".$now->month."".$now->year."/".time(),
    		"customer_id" => "CUST".time()
    	);

        if(\Auth::user() -> staff_position < 6){
            $transactions = Transaction::all();
            $outlets = Outlet::all();
        }
        else if(\Auth::user() -> staff_position == 6 || \Auth::user() -> staff_position == 8){
            $transactions = Transaction::where('outlet_id', \Auth::user() -> outlet_id)->get();
            $outlets = Outlet::where('id', \Auth::user() -> outlet_id) -> get();
        }
        else if(\Auth::user() -> staff_position == 7){
            $transactions = Transaction::whereRaw("outlet_id in (select id from outlets where partner_id='".\Auth::user() -> partner_id."')")->get();
            $outlets = Outlet::whereRaw("id in (select id from outlets where partner_id='".\Auth::user() -> partner_id."')") -> get();
        }

        return view('dashboard.transaction.dashboard', compact('outlets', 'rand', 'transactions'));

    }

    public function inputNewTransaction(Request $request){

        $timestamp = strtotime($request -> transaction_datetime);

        $newTransaction = new Transaction();
        $newTransaction -> invoice = $request -> invoice_num;
        $newTransaction -> outlet_id = $request -> outlet_id;
        $newTransaction -> discount = $request -> master_discount;
        $newTransaction -> transaction_datetime = date("Y-m-d H:i:s", $timestamp);
        $newTransaction -> create_by = \Auth::user()->id;

        if($newTransaction -> save()){

            $newCustomer = new Customer();
            $newCustomer -> customer_id = $request -> customer_id;
            $newCustomer -> name = $request -> customer_name;
            $newCustomer -> birthdate = \DateTime::createFromFormat('d/m/Y', $request -> customer_birthdate);
            $newCustomer -> address = $request -> customer_address;
            $newCustomer -> phone_number = $request -> customer_phone_number;
            $newCustomer -> transaction_id = $newTransaction -> id;
            $newCustomer -> create_by = \Auth::user()->id;

            if($newCustomer -> save()){

                for($i = 1; $i <= $request -> transaction_detail_row; $i++){

                    if(!empty($request['service_'.$i]) && !empty($request['qty_'.$i]) && $request['qty_'.$i] != 0){

                        $service = explode('-', $request['service_'.$i]);

                        $newDetail = new TransactionDetail();
                        $newDetail -> transaction_id = $newTransaction -> id; 
                        $newDetail -> service_id = $service[0]; 
                        $newDetail -> service_type = $service[1]; 
                        $newDetail -> employee_id = $request['capster_'.$i]; 
                        $newDetail -> price = $request['price_'.$i]; 
                        $newDetail -> qty = $request['qty_'.$i]; 
                        $newDetail -> discount = $request['discount_'.$i]; 
                        $newDetail -> create_by = \Auth::user()->id;
                        $newDetail -> save();

                    }

                }

                return redirect()
                ->back()
                ->with('success', 'Transaksi telah disimpan.');

            }
            else{
                return redirect()
                ->back()
                ->withErrors([
                    'err_msg' => 'Gagal menyimpan data pelanggan, hubungi administrator untuk info lebih lanjut.',
                ]);
            }

        }
        else{
            return redirect()
            ->back()
            ->withErrors([
                'err_msg' => 'Gagal menyimpan data transaksi, hubungi administrator untuk info lebih lanjut.',
            ]);
        }

    }

    public function showEditTransaction($id){

        $outlets = Outlet::all();
        $transaction = Transaction::findOrFail($id);
        $transaction->transaction_datetime = Carbon::parse($transaction->transaction_datetime)->format('m/d/Y h:i A');
        $customer = Customer::where('transaction_id',$id)->get()->first();
        $customer->birthdate = Carbon::parse($customer->birthdate)->format('d/m/Y');
        $capsters = Employee::where('outlet_id', $transaction->outlet_id)->whereIn('staff_position', [8, 9, 10])->get();
        $transactionDetail = TransactionDetail::where('transaction_id',$id)->get();

        $servicePrices = \DB::table('service_prices')
                        ->selectRaw('service_prices.service_id, services.name, sum(case when service_prices.type=1 then price else 0 end) as adult_price, sum(case when service_prices.type=2 then price else 0 end) as kid_price')
                        ->join('services', 'service_prices.service_id', '=', 'services.id')
                        ->where('service_prices.outlet_id', '=', $transaction->outlet_id)
                        ->groupBy('service_prices.service_id')
                        ->get();

        $prices = array();
        foreach ($servicePrices as $servicePrice) {
            $adult = array(
                "name" => $servicePrice->name." - Adult",
                "service_id" => $servicePrice->service_id."-1",
                "price" => $servicePrice->adult_price
            );

            $kid = array(
                "name" => $servicePrice->name." - Kid",
                "service_id" => $servicePrice->service_id."-2",
                "price" => $servicePrice->kid_price
            );

            array_push($prices, $adult);
            array_push($prices, $kid);
        }

        $pricesStr = json_encode($prices);
        $pricesStr = str_replace('&quot;', '"', $pricesStr);

        $capsterJs = array();
        foreach ($capsters as $capster) {
            $caps = array(
                "id" => $capster->id,
                "name" => $capster->name,
                "staff_position" => $capster->staff_position
            );

            array_push($capsterJs, $caps);
        }

        $capstersStr = json_encode($capsterJs);
        $capstersStr = str_replace('&quot;', '"', $capstersStr);

        return view('dashboard.transaction.edit', compact('outlets', 'transaction', 'customer', 'transactionDetail', 'capsters', 'prices', 'pricesStr', 'capstersStr'));

    }

    public function editTransaction(Request $request, $id){

        $timestamp = strtotime($request -> transaction_datetime);

        $transaction = Transaction::findOrFail($id);
        $transaction -> invoice = $request -> invoice_num;
        $transaction -> outlet_id = $request -> outlet_id;
        $transaction -> transaction_datetime = date("Y-m-d H:i:s", $timestamp);
        $transaction -> discount = $request -> master_discount;
        $transaction -> update_by = \Auth::user()->id;

        if($transaction -> save()){

            $customer = Customer::where('transaction_id',$id)->get()->first();
            $customer -> customer_id = $request -> customer_id;
            $customer -> name = $request -> customer_name;
            $customer -> birthdate = \DateTime::createFromFormat('d/m/Y', $request -> customer_birthdate);
            $customer -> address = $request -> customer_address;
            $customer -> phone_number = $request -> customer_phone_number;
            $customer -> transaction_id = $transaction -> id;
            $customer -> update_by = \Auth::user()->id;

            if($customer -> save()){

                $delItems = \DB::table('transaction_details')->where('transaction_id', $id)->delete();

                for($i = 1; $i <= $request -> transaction_detail_row; $i++){

                    if(!empty($request['service_'.$i]) && !empty($request['qty_'.$i]) && $request['qty_'.$i] != 0){

                        $service = explode('-', $request['service_'.$i]);

                        $newDetail = new TransactionDetail();
                        $newDetail -> transaction_id = $transaction -> id; 
                        $newDetail -> service_id = $service[0]; 
                        $newDetail -> service_type = $service[1]; 
                        $newDetail -> employee_id = $request['capster_'.$i];
                        $newDetail -> price = $request['price_'.$i]; 
                        $newDetail -> qty = $request['qty_'.$i]; 
                        $newDetail -> discount = $request['discount_'.$i]; 
                        $newDetail -> create_by = \Auth::user()->id;
                        $newDetail -> save();

                    }

                }

                return redirect()
                ->back()
                ->with('success', 'Data transaksi telah disimpan.');
            }
            else{

                return redirect()
                ->back()
                ->withErrors([
                    'err_msg' => 'Gagal menyimpan data pelanggan, hubungi administrator untuk info lebih lanjut.',
                ]);
            }

        }
        else{
            
            return redirect()
            ->back()
            ->withErrors([
                'err_msg' => 'Gagal menyimpan data transaksi, hubungi administrator untuk info lebih lanjut.',
            ]);
        }

    }

    public function deleteTransaction($id){

        $transaction = Transaction::findOrFail($id);
        $transaction -> delete();

        if ($transaction->trashed()) {
            return redirect()
                ->back()
                ->with('success', 'Data transaski telah dihapus.');
        }
        else{
            return redirect()
                ->back()
                ->withErrors([
                    'err_msg' => 'Gagal menghapus transaksi, hubungi administrator untuk info lebih lanjut.',
                ]);
        }

    }

}