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
        <input type="hidden" name="order_id" value="{{$data['order']['id']}}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>주문ID</td>
            <td>{{$data['order']['id']}}</td>
          </tr>
          <tr>
            <td>주문수량</td>
            <td>{{$data['order']['quantity']}}</td>
          </tr>
        </table>
        <div class="box-footer">
            <button type="button" class="btn btn-danger" id="order_destory" onclick="window.history.back();">취소</button>
            <button type="submit" class="btn btn-primary pull-right">변경</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

