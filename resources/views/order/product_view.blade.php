@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">상품 상세보기</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" action="{{ URL::route('order_product_submit') }}" id="order_product_submit">
        <input type="hidden" name="product_id" value="{{$data['product']['id']}}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>상품ID</td>
            <td>{{$data['product']['id']}}</td>
          </tr>
          <tr>
            <td>상품명</td>
            <td>{{$data['product']['name']}}</td>
          </tr>
          <tr>
            <td>상품설명</td>
            <td>{{$data['product']['desc']}}</td>
          </tr>
          <tr>
            <td>판매가능수량</td>
            <td>{{$data['product']['quantity']}}</td>
          </tr>
          <tr>
            <td>영업사원</td>
            <td>{{$data['product']->salesman['name']}}</td>
          </tr>
        </table>
        <div class="box-footer">
            <button type="button" class="btn btn-danger" id="product_destory">취소</button>
            <button type="submit" class="btn btn-primary pull-right">구매</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
