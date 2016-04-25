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
            <td>사진</td>
            <td>
              <!-- 사진 넣기 -->
              @if(count($data['product']->images))
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    @foreach ($data['product']->images as $key=>$val)
                      <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" @if($key==0) class="active" @endif></li>
                    @endforeach
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox" style="align:center">
                    @foreach ($data['product']->images as $key=>$val)
                    <div class=@if($key==0) "item active" @else "item" @endif>
                      <img src="{{env('AWS_S3_URL')}}/product/{{$val}}">
                    </div>
                    @endforeach
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              @else
                <strong>상품 사진이 없습니다.</strong>
              @endif
            </td>
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
          <tr>
            <td>구매수량</td>
            <td><input type="number" name="item_count" placeholder="구매수량"></td>
          </tr>
        </table>
        <div class="box-footer">
            <button type="button" class="btn btn-danger" id="product_destory" onclick="window.history.back();">취소</button>
            <button type="submit" class="btn btn-primary pull-right">구매</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
