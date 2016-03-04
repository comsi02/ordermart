@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">상품수정</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" action="{{ URL::route('product_create_submit') }}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>상품명</td>
            <td><input type="text" class="form-control" name="name" placeholder="상품명을 입력해 주세요."></td>
          </tr>
          <tr>
            <td>상품설명</td>
            <td><textarea class="form-control" rows="10" name="desc" placeholder="상품설명을 입력해 주세요."></textarea></td>
          </tr>
          <tr>
            <td>판매가능수량</td>
            <td><input type="number" class="form-control" name="quantity" placeholder="0"></td>
          </tr>
          <tr>
            <td>영업사원</td>
            <td>{{Auth::user()->name}}</td>
          </tr>
        </table>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">등록</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
