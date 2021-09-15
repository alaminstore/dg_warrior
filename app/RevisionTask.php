<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevisionTask extends Model
{
    public function getJobPost(){
        return $this->belongsTo(JobPost::class, 'job_id', 'id');
    }
}
