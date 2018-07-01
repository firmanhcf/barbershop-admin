<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;
	
    protected $table = 'assets';

    public function outlet()
    {
        return $this->belongsTo('App\Outlet', 'outlet_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo('App\AssetItem', 'item_id', 'id');
    }
}
