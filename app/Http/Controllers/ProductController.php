<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Salesman;

class ProductController extends Controller
{
    public function index() {
        $products = Product::where('status','SALE')->orderBy('id', 'desc')->paginate(5);
        return view('product.index', compact('products'));
    }

    public function create() {
        return view('product.create');
    }

    public function create_submit() {

        $product = new Product();
        $product->name = \Input::get('name');
        $product->desc = \Input::get('desc');
        $product->quantity = \Input::get('quantity');
        $product->user_id = \Auth::user()->id;
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
            'product' => $product,
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

    public function destory() {
        try {
            \DB::beginTransaction();

            $product = Product::find(\Input::get('product_id'));
            $product->status = 'STOP';
            $product->save();

            \DB::commit();
        } catch (exception $e) {
            \DB::rollback();
            return \Response::json(['result' => 'success']);
        }
        return \Response::json(['result' => 'success']);
    }

    public function order($salesman) {
        $products = Product::where('status','SALE')->where('user_id',$salesman)->paginate(5);
        return view('product.order', compact('products'));
    }

    public function order_view($id) {
        $product = Product::find($id);

        $data = [
            'product' => $product
        ];

        return view('product.order_view', compact('data'));
    }
}
