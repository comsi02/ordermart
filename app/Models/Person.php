<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'users';

    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
}
