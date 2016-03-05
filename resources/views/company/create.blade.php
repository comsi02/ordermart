@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">거래처 등록</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" action="{{ URL::route('company_create_submit') }}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>거래처명</td>
            <td><input type="text" class="form-control" name="name" placeholder="거래처명을 입력해 주세요."></td>
          </tr>
          <tr>
            <td>상태</td>
            <td>
                <input type="radio" name="status_group" value="Y" checked>영업중
                <input type="radio" name="status_group" value="N">영업완료
            </td>
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
