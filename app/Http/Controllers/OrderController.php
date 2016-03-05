<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Person;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index() {

        $salesman = Person::paginate(5);

        $data = [
            'salesman' => $salesman
        ];

        return view('order.index', compact('data'));
    }

    public function product() {

        $data = \Request::get();

        try {

            \DB::beginTransaction();

            $order = new Order();
            $order->product_id = $data['product_id'];
            $order->user_id = \Auth::user()->id;
            $order->quantity = $data['item_count'];
            $order->status = 'Inprogress';
            $order->save();

            $product = Product::find($data['product_id']);
            $product->quantity = $product->quantity - $data['item_count'];
            $product->save();

            // 견적서 메일 발송
            \Event::fire('order.send_mail', [$data]);
            \DB::commit();

        } catch (exception $e) {
            \DB::rollback();
            return \Response::json(['result' => 'error']);
        }
        return \Response::json(['result' => 'success']);
    }

/*
    public function create() {
        return view('product.create');
    }

    public function create_submit() {

        $product = new Product();
        $product->name = \Request::get('name');
        $product->desc = \Request::get('desc');
        $product->quantity = \Request::get('quantity');
        $product->salesman = \Auth::user()->id;
        $product->status = 'SALE';
        $product->save();

        return \Redirect()->action('ProductController@index');
    }

    public function view($id) {
        $product = Product::find($id);

        $data = [
            'product' => $product
        ];

        return view('product.view', compact('data'));
    }

    public function edit($id) {
        $product = Product::find($id);

        $data = [
            'product' => $product
        ];

        return view('product.edit', compact('data'));
    }

    public function edit_submit() {

        $product = Product::find(\Request::get('product_id'));
        $product->name = \Request::get('name');
        $product->desc = \Request::get('desc');
        $product->quantity = \Request::get('quantity');
        $product->save();

        return \Redirect()->action('ProductController@index');
    }

    public function destory($id) {
        $product = Product::find($id);

        $data = [
            'product' => $product
        ];


        return view('product.destory', compact('data'));
    }

    public function destory_submit() {
        $product = Product::find(\Request::get('product_id'));
        $product->status = 'STOP';
        $product->save();

        return \Redirect()->action('ProductController@index');
    }
*/
}
