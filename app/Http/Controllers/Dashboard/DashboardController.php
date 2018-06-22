<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Outlet;
use App\Partner;
use App\Transaction;

class DashboardController extends Controller
{
    
    public function showMainDashboard()
    {

    	$outletQuery = "";

        if(\Auth::user() -> staff_position == 6 || \Auth::user() -> staff_position == 8) {

            $outletQuery = " and transactions.outlet_id='".\Auth::user()->outlet_id."' ";
            
        }
        else if(\Auth::user() -> staff_position == 7) {

            $outletQuery = " and transactions.outlet_id in (select id from outlets where partner_id='".\Auth::user() -> partner_id."') ";

        }
    	
    	$transactionToday = Transaction::whereRaw('Date(created_at) = CURDATE()'.$outletQuery)->count();
    	$revenueToday = \DB::select(\DB::raw("select 
    											TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from sum(a.total - ((a.discount/100) * a.total)))) as after_discount
												from
												(
												select
												transaction_details.transaction_id, 
												transactions.discount,
												sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty))) as total
												from transaction_details
												inner join transactions on transaction_details.transaction_id = transactions.id where transactions.deleted_at is null ".$outletQuery." and date(transactions.created_at) = CURDATE() group by transaction_details.transaction_id
												) a"));

    	$transactionThisMonth = Transaction::whereRaw('month(created_at) = month(CURDATE())'.$outletQuery)->count();

    	$revenueThisMonth = \DB::select(\DB::raw("select 
    											TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from sum(a.total - ((a.discount/100) * a.total)))) as after_discount
												from
												(
												select
												transaction_details.transaction_id, 
												transactions.discount,
												sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty))) as total
												from transaction_details
												inner join transactions on transaction_details.transaction_id = transactions.id where transactions.deleted_at is null ".$outletQuery." and month(transactions.created_at) = month(CURDATE()) group by transaction_details.transaction_id
												) a"));

    	$transactionsOfToday = Transaction::whereRaw('Date(created_at) = CURDATE() '.$outletQuery)->get();
    	$transactionsOfThisMonth = Transaction::whereRaw('month(created_at) = month(CURDATE())'.$outletQuery)->get();

        return view('dashboard.main', compact('outlets', 'partners', 'transactionToday', 'revenueToday', 'transactionThisMonth', 'revenueThisMonth', 'transactionsOfToday', 'transactionsOfThisMonth'));
    }

    public function showTransactionDashboard()
    {
        return view('dashboard.transaction');
    }
}