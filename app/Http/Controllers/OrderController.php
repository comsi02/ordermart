<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Salesman;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function index() {

        $salesman = Salesman::paginate(5);

        $data = [
            'salesman' => $salesman
        ];

        return view('order.index', compact('data'));
    }

    public function product() {

        $data = \Input::get();

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

            \DB::commit();

            \Event::fire('order.send_mail', [$data]);

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
        $product->name = \Input::get('name');
        $product->desc = \Input::get('desc');
        $product->quantity = \Input::get('quantity');
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

        $product = Product::find(\Input::get('product_id'));
        $product->name = \Input::get('name');
        $product->desc = \Input::get('desc');
        $product->quantity = \Input::get('quantity');
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
        $product = Product::find(\Input::get('product_id'));
        $product->status = 'STOP';
        $product->save();

        return \Redirect()->action('ProductController@index');
    }
*/
}
