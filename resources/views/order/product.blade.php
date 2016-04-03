@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">상품 주문</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th>상품명</th>
            <th>전체수량</th>
            <th>남은수량</th>
            <th>구매완료</th>
            <th>구매대기</th>
            <th>기능</th>
          </tr>
          @foreach($data['product'] as $p)
          <tr>
            <td rowspan=2>{{ $p->name }}</td>
            <td>{{ $p->quantity }}</td>
            <td>{{ $p->remain_count }}</td>
            <td>{{ $p->booked }}</td>
            <td>{{ $p->inprogress }}</td>
            <td rowspan=2>
                <a href="{{ url('order/product/view/'.$p->id) }}">
                    <button type="submit" class="btn btn-primary">구매</button>
                </a>
            </td>
          </tr>
          <tr>
            <td colspan=4>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar progress-bar-danger" style="width: {{$p->sales_ratio}}%"></div>
              </div>
            <td>
          </tr>
          @endforeach
        </table>
        <div class="pull-right"> {!! $data['product']->render() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection

