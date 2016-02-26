<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::paginate(15);
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
        $product->salesman = \Auth::user()->id;
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
        return view('product.destory', compact('data'));
    }
}
