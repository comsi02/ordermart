@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">거래처 수정</h3>
      </div>
      <div class="box-body">
        <form method="post" action="{{ URL::route('company_edit_submit') }}" id="company_create_submit">
        <input type="hidden" name="company_id" value="{{$data['company']['id']}}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>거래처ID</td>
            <td>{{$data['company']['id']}}</td>
          </tr>
          <tr>
            <td>거래처명</td>
            <td><input type="text" class="form-control" name="name" value="{{$data['company']['name']}}"></td>
          </tr>
          <tr>
            <td>상태</td>
            <td>
              <input type="radio" name="status_group" id="status_y" value="Y" @if ($data['company']['status'] == 'Y') checked @endif><label for="status_y">영업중</label><br>
              <input type="radio" name="status_group" id="status_n" value="N" @if ($data['company']['status'] == 'N') checked @endif><label for="status_n">영업종료</label>
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
