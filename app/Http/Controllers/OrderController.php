<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Company;
use App\Models\Product;
use App\Models\Person;
use App\Models\Order;

class OrderController extends Controller
{
    public function company() {
        $company = Company::where('status','Y')->orderBy('id', 'desc')->paginate(5);

        $data = [
            'company' => $company
        ];

        return view('order.company', compact('data'));
    }

    public function person($company_id) {
        $person = Person::where('salesman_yn','Y')->where('company_id',$company_id)->orderBy('id', 'desc')->paginate(5);

        $data = [
            'person' => $person
        ];

        return view('order.person', compact('data'));
    }

    public function product($user_id) {
        $product = Order::get_product_list();

        $data = [
            'product' => $product
        ];

        return view('order.product', compact('data'));
    }

    public function product_view($id) {
        $product = Product::find($id);

        $data = [
            'product' => $product
        ];

        return view('order.product_view', compact('data'));
    }

    public function product_submit() {

        $data = \Request::input();

        try {

            \DB::beginTransaction();

            $order = new Order();
            $order->product_id = $data['product_id'];
            $order->user_id = \Auth::user()->id;
            $order->quantity = $data['item_count'];
            $order->status = 'Inprogress';
            $order->save();

            // 견적서 메일 발송
            //\Event::fire('order.send_mail', [$data]);
            \DB::commit();

        } catch (exception $e) {
            \DB::rollback();
            #return \Response::json(['result' => 'error']);
        }
        #return \Response::json(['result' => 'success']);
        return \Redirect()->route('order_product',1); // 영업사원 user_id 로 변경 해야 함.
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
