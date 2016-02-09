@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

                <div class="panel-body">

                    <!-- body start -->
                    <a href="{{ url('product/create') }}" class="btn btn-primary pull-right btn-sm">상품추가</a>
                    <br>
                    <br>
                    <div class="table">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>상품ID</th>
                                    <th>상품명</th>
                                    <th>상품설명</th>
                                    <th>판매가능수량</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            {{-- */$x=0;/* --}}
                            @foreach($products as $item)
                                {{-- */$x++;/* --}}
                                <tr>
                                    <td>{{ $x }}</td>
                                    <td><a href="{{ url('product', $item->id) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->desc }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        <a href="{{ url('product/' . $item->id . '/edit') }}">
                                            <button type="submit" class="btn btn-primary btn-xs">수정</button>
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
            </div>
        </div>
    </div>
</div>

@endsection

