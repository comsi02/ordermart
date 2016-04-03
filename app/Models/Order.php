<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public static function get_product_list()
    {
        $result = \DB::table('products as p')
                    ->select(\DB::raw('p.*, p.quantity - sum(o.quantity) as remain_count, sum(o.quantity) as total_quantity, sum(if(o.status = \'booked\',o.quantity,0)) as booked, sum(if(o.status = \'inprogress\',o.quantity,0)) as inprogress, round(ifnull((p.quantity / sum(o.quantity)) * 10,0),0) as sales_ratio'))
                    ->join('orders as o', 'p.id', '=', 'o.product_id')
                    ->groupBy('p.id')
                    ->paginate(5);

        return $result;
    }
}
