@extends('layouts.app')

@section('content')

                <div class="panel-heading">Orders - index</div>

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
                            @foreach($data['salesman'] as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('product/order/'.$item->id) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->email}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination"> {!! $data['salesman']->render() !!} </div>
                    </div>
                    <!-- body start -->

                </div>

@endsection

