<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
	use SoftDeletes;
	
    protected $table = 'partners';

    public function outlets()
    {
        return $this->hasMany('App\Outlet', 'partner_id', 'id');
    }
}
