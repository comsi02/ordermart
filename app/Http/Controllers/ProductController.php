<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Order;

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
        $product->name = \Request::get('name');
        $product->desc = \Request::get('desc');
        $product->quantity = \Request::get('quantity');
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
        $product_image = ProductImage::where('product_id',$id)->get()[0];

        $data = [
            'product' => $product,
            'product_image' => $product_image
        ];

        return view('product.edit', compact('data'));
    }

    public function edit_submit() {

        $data = \Request::all();

        $product = Product::find($data['product_id']);
        $product->name = $data['name'];
        $product->desc = $data['desc'];
        $product->quantity = $data['quantity'];
        $product->save();

        # TODO: product_image 를 json 으로 변경해서 product 테이블에 추가 하자...
        # TODO: multi image upload 가능한 라이브러리를 찾아서 변경 필요.
        $product_image = ProductImage::find($data['product_id']);
        $product_image->product_id = $data['product_id'];
        $product_image->img_type = 'm';

        if (isset($data['image'])) {
            $file_name = \Common::get_img_filename($data['image']);
            \Common::make_product_img($file_name,720);
            $res = \Common::s3_upload($file_name,'product/');
            if ($res['success']) {
                $product_image->img_name = $res['filename'];
            }
        }

        $product_image->save();

        return \Redirect()->action('ProductController@index');
    }

    public function destory() {
        try {
            \DB::beginTransaction();

            $product = Product::find(\Request::get('product_id'));
            $product->status = 'STOP';
            $product->save();

            \DB::commit();
        } catch (exception $e) {
            \DB::rollback();
            return \Response::json(['result' => 'success']);
        }
        return \Response::json(['result' => 'success']);
    }

    public function order() {
        $user_id = \Auth::user()->id;
        $orders = Order::where('user_id',$user_id)->orderBy('id','desc')->paginate(5);
        return view('product.order', compact('orders'));
    }

    public function order_view($id) {
        $order = Order::find($id);

        $data = [
            'order' => $order
        ];

        return view('product.order_view', compact('data'));
    }
}
