<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public static function get_product_list()
    {
        $query = "
            select
                p.*, 
                p.quantity - sum(o.quantity) as remain_count,
                sum(o.quantity) as total_quantity,
                sum(if(o.status = 'booked',o.quantity,0)) as booked,
                sum(if(o.status = 'inprogress',o.quantity,0)) as inprogress
            from products p
            inner join orders o on p.id = o.product_id
            where o.status in ('bulk','booked','inprogress')
            group by p.id
       ";

        $res = DB::select($query);

\Log::info($res);

        
    }
}
