<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class SubmitTask extends Model
{
    public function getUserName(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function getJob(){
        return $this->belongsTo(JobPost::class,'job_id');
    }
}
