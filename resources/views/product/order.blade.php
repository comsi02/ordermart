@extends('layouts.app')

@section('content')

                <div class="panel-heading">Products</div>

                <div class="panel-body">

                    <!-- body start -->
                    <div class="table">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>상품ID</th>
                                    <th>상품명</th>
                                    <th>판매가능수량</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('product/view/'.$item->id) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        <a href="{{ url('product/order/view/'.$item->id) }}">
                                            <button type="submit" class="btn btn-primary">주문</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination"> {!! $products->render() !!} </div>
                    </div>
                    <!-- body start -->

                </div>

@endsection

