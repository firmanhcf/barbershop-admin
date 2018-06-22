<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPks extends Model
{
    use SoftDeletes;

    protected $table = 'user_pks';
}
