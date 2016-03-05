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
        <form method="post" action="{{ URL::route('company_edit_submit') }}" id="company_create_submit">
        <input type="hidden" name="company_id" value="{{$data['company']['id']}}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>상품ID</td>
            <td>{{$data['company']['id']}}</td>
          </tr>
          <tr>
            <td>상품명</td>
            <td><input type="text" class="form-control" name="name" value="{{$data['company']['name']}}"></td>
          </tr>
          <tr>
            <td>상태</td>
            <td>
              <input type="radio" name="status_group" value="Y" @if ($data['company']['status'] == 'Y') checked @endif>영업중
              <input type="radio" name="status_group" value="N" @if ($data['company']['status'] == 'N') checked @endif>영업완료
            </td>
          </tr>
        </table>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">수정</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
