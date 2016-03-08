@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">상품</h3>
        <a href="{{ url('product/create') }}" class="btn btn-primary pull-right btn-sm">상품추가</a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th>상품ID</th>
            <th>상품명</th>
            <th>판매가능수량</th>
            <th>기능</th>
          </tr>
          @foreach($products as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>
              {{ $item->quantity }}
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar progress-bar-danger" style="width: {{$item->quantity}}%"></div>
              </div>
            </td>
            <td>
              <a href="{{ url('product/edit/'.$item->id) }}">
                <button type="submit" class="btn btn-primary">상세보기</button>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="pull-right"> {!! $products->render() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection

