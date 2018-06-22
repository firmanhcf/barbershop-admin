<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outlet extends Model
{
	use SoftDeletes;

    protected $table = 'outlets';

    public function owner()
    {
        return $this->belongsTo('App\Partner', 'partner_id', 'id');
    }

    public function partnership()
    {
        return $this->belongsTo('App\Partnership', 'partnership_id', 'id');
    }

    public function provinces()
    {
        return $this->belongsTo('App\Province', 'province', 'id');
    }

    public function regencies()
    {
        return $this->belongsTo('App\Regency', 'regency', 'id');
    }

    public function districts()
    {
        return $this->belongsTo('App\District', 'district', 'id');
    }


}
