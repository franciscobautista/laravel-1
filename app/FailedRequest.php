<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FailedRequest extends Model
{
    protected $fillable = ['request_id','description'];
}
