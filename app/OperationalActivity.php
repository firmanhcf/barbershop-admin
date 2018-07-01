<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperationalActivity extends Model
{
    use SoftDeletes;
	
    protected $table = 'operational_activities';

    public function outlet()
    {
        return $this->belongsTo('App\Outlet', 'outlet_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo('App\OperationalItem', 'item_id', 'id');
    }
}
