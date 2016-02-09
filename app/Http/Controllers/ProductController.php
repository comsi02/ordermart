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

        return view('product.view', compact('data'));
    }

    public function destory($id) {
    }
}
