<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $guarded = [];

    public function feedable()
    {
        $this->morphTo();
    }
}
