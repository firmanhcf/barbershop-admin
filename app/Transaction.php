<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
	use SoftDeletes;
	
    protected $table = 'transactions';

    public function outlet()
    {
        return $this->belongsTo('App\Outlet', 'outlet_id', 'id');
    }

    public function capster()
    {
        return $this->belongsTo('App\Employee', 'capster_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'id', 'transaction_id');
    }

    public function items()
    {
    	return $this->hasMany('App\TransactionDetail', 'transaction_id', 'id');
    }

    public function getTotalPriceOfItem() {

	    return $this->items()->sum(\DB::raw('(qty * price) - ((discount/100) * (qty * price))'));
	}

	public function getTotalPriceAfterDiscount() {

	    return ($this->getTotalPriceOfItem() - (($this->discount/100) * $this->getTotalPriceOfItem()));
	}
}
