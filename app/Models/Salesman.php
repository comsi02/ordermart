<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    protected $table = 'users';

    public function product()
    {
        return $this->hasMany('Product','salesman');
    }
}
