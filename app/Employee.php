<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    public function outlet()
    {
        return $this->belongsTo('App\Outlet', 'outlet_id', 'id');
    }
}
