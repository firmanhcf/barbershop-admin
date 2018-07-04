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

        if(\Auth::user() -> staff_position == 6 || \Auth::user() -> staff_position == 8 || \Auth::user() -> staff_position == 9 || \Auth::user() -> staff_position == 10 ) {

            $outletQuery = " and transactions.outlet_id='".\Auth::user()->outlet_id."' ";
            
        }
        else if(\Auth::user() -> staff_position == 7) {

            $outletQuery = " and transactions.outlet_id in (select id from outlets where partner_id='".\Auth::user() -> partner_id."') ";

        }
    	
        $transactionToday = Transaction::whereRaw('Date(transaction_datetime) = CURDATE()'.$outletQuery)->count();
    	$transactionsOfToday = \DB::select(\DB::raw("select 
                                                    outlets.id,
                                                    outlets.outlet_id,
                                                    outlets.name,
                                                    outlets.address,
                                                    regencies.name as regency,
                                                    ifnull(trans.hair_cut,0) as hair_cut,
                                                    ifnull(trans.shave,0) as shave,
                                                    ifnull(trans.massage, 0) as massage,
                                                    ifnull(trans.training, 0) as training,
                                                    ifnull((TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from trans.total_after_discount))),0) as total_after_discount

                                                    from outlets
                                                    left join 
                                                    (
                                                    select
                                                    transactions.outlet_id,
                                                    transaction_details.transaction_id, 
                                                    sum(case when transaction_details.service_id = 1 then qty else 0 end) as hair_cut,
                                                    sum(case when transaction_details.service_id = 2 then qty else 0 end) as shave,
                                                    sum(case when transaction_details.service_id = 3 then qty else 0 end) as massage,
                                                    sum(case when transaction_details.service_id = 4 then qty else 0 end) as training,
                                                    transactions.discount,
                                                    sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty))) as subtotal,
                                                    sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty))) - ((transactions.discount/100) * sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty)))) as total_after_discount
                                                    from transaction_details
                                                    inner join transactions on transaction_details.transaction_id = transactions.id where transactions.deleted_at is null and date(transactions.transaction_datetime) = CURDATE() group by transaction_details.transaction_id
                                                    ) trans on outlets.id = trans.outlet_id
                                                    left join regencies on outlets.regency=regencies.id
                                                    where outlets.deleted_at is null ".$outletQuery));

    	$revenueToday = \DB::select(\DB::raw("select 
    											TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from sum(a.total - ((a.discount/100) * a.total)))) as after_discount
												from
												(
												select
												transaction_details.transaction_id, 
												transactions.discount,
												sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty))) as total
												from transaction_details
												inner join transactions on transaction_details.transaction_id = transactions.id where transactions.deleted_at is null ".$outletQuery." and date(transactions.transaction_datetime) = CURDATE() group by transaction_details.transaction_id
												) a"));

        $transactionThisMonth = Transaction::whereRaw('month(transaction_datetime) = month(CURDATE())'.$outletQuery)->count();
    	$transactionsOfThisMonth = \DB::select(\DB::raw("select 
                                                    outlets.id,
                                                    outlets.outlet_id,
                                                    outlets.name,
                                                    outlets.address,
                                                    regencies.name as regency,
                                                    ifnull(trans.hair_cut,0) as hair_cut,
                                                    ifnull(trans.shave,0) as shave,
                                                    ifnull(trans.massage, 0) as massage,
                                                    ifnull(trans.training, 0) as training,
                                                    ifnull((TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from trans.total_after_discount))),0) as total_after_discount

                                                    from outlets
                                                    left join 
                                                    (
                                                    select
                                                    transactions.outlet_id,
                                                    transaction_details.transaction_id, 
                                                    sum(case when transaction_details.service_id = 1 then qty else 0 end) as hair_cut,
                                                    sum(case when transaction_details.service_id = 2 then qty else 0 end) as shave,
                                                    sum(case when transaction_details.service_id = 3 then qty else 0 end) as massage,
                                                    sum(case when transaction_details.service_id = 4 then qty else 0 end) as training,
                                                    transactions.discount,
                                                    sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty))) as subtotal,
                                                    sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty))) - ((transactions.discount/100) * sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty)))) as total_after_discount
                                                    from transaction_details
                                                    inner join transactions on transaction_details.transaction_id = transactions.id where transactions.deleted_at is null and month(transaction_datetime) = month(CURDATE()) group by transaction_details.transaction_id
                                                    ) trans on outlets.id = trans.outlet_id
                                                    left join regencies on outlets.regency=regencies.id
                                                    where outlets.deleted_at is null ".$outletQuery));

    	$revenueThisMonth = \DB::select(\DB::raw("select 
    											TRIM(TRAILING '.' FROM TRIM(TRAILING '0' from sum(a.total - ((a.discount/100) * a.total)))) as after_discount
												from
												(
												select
												transaction_details.transaction_id, 
												transactions.discount,
												sum((transaction_details.price*transaction_details.qty)-((transaction_details.discount/100)*(transaction_details.price*transaction_details.qty))) as total
												from transaction_details
												inner join transactions on transaction_details.transaction_id = transactions.id where transactions.deleted_at is null ".$outletQuery." and month(transactions.transaction_datetime) = month(CURDATE()) group by transaction_details.transaction_id
												) a"));

    	// $transactionsOfToday = Transaction::whereRaw('Date(transaction_datetime) = CURDATE() '.$outletQuery)->get();
    	// $transactionsOfThisMonth = Transaction::whereRaw('month(transaction_datetime) = month(CURDATE())'.$outletQuery)->get();

        return view('dashboard.main', compact('outlets', 'partners', 'transactionToday', 'revenueToday', 'transactionThisMonth', 'revenueThisMonth', 'transactionsOfToday', 'transactionsOfThisMonth'));
    }

    public function showTransactionDashboard()
    {
        return view('dashboard.transaction');
    }
}