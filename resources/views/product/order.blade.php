@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">주문확인</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th>주문ID</th>
            <th>수량</th>
            <th>상태</th>
            <th>주문자</th>
            <th>기능</th>
          </tr>
          @foreach($orders as $o)
          <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->quantity }}</td>
            <td>{{ $o->status }}</td>
            <td>{{ $o->user_id}}</td>
            <td>
              <a href="{{ url('product/order/view/'.$o->id) }}">
                <button type="submit" class="btn btn-primary">상세보기</button>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="pull-right"> {!! $orders->render() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection

