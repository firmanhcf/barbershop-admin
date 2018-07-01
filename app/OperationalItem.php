<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperationalItem extends Model
{
    use SoftDeletes;
	
    protected $table = 'operational_items';
}
