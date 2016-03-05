@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">사용자 수정</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" action="{{ URL::route('person_edit_submit') }}" id="person_create_submit">
        <input type="hidden" name="person_id" value="{{$data['person']['id']}}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>ID</td>
            <td>{{$data['person']['id']}}</td>
          </tr>
          <tr>
            <td>이름</td>
            <td><input type="text" class="form-control" name="name" value="{{$data['person']['name']}}"></td>
          </tr>
          <tr>
            <td>E-Mail</td>
            <td><input type="text" class="form-control" name="email" value="{{$data['person']['email']}}"></td>
          </tr>
          <tr>
            <td>권한</td>
            <td>
              <input type="checkbox" name="auth_admin" id="auth_admin" value="Y" @if ($data['person']['admin_yn'] == 'Y') checked @endif>
              <label for="auth_admin">관리자</label><br>

              <input type="checkbox" name="auth_salesman" id="auth_salesman" value="Y" @if ($data['person']['salesman_yn'] == 'Y') checked @endif>
              <label for="auth_salesman">영업사원</label><br>

              <input type="checkbox" name="auth_client" id="auth_client" value="Y" @if ($data['person']['client_yn'] == 'Y') checked @endif>
              <label for="auth_client">고객</label><br>
            </td>
          </tr>
          <tr>
            <td>거래처</td>
            <td>{{$data['person']->company['name']}}</td>
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
