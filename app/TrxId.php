<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrxId extends Model
{
    public function getUser(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
