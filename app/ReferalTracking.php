<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class ReferalTracking extends Model
{
    protected $guarded=[];

    public function getUserName(){
        return $this->belongsTo(User::class,'user');
    }
}
