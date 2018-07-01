<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetItem extends Model
{
    use SoftDeletes;
	
    protected $table = 'asset_items';
}
