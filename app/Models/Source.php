<?php

namespace App\Models;

use App\Models\BaseModel;

class Source extends BaseModel
{
    public function customers()
    {
    	return $this->hasMany('App\Models\Customer');
    }

    public function jobs()
    {
    	return $this->hasManyThrough('App\Models\Job', 'App\Models\Customer');
    }

    public function canBeDeleted()
    {
        $c = $this->customers->count();

        if($c >= 1)
        {
            return false;
        }

        else
        {
            return true;
        }

    }
}


