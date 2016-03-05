<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function salesman()
    {
        return $this->belongsTo('App\Models\Person','user_id');
    }
}
