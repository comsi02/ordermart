@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">거래처</h3>
        <a href="{{ url('company/create') }}" class="btn btn-primary pull-right">거래처추가</a>
      </div>
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th>CI</th>
            <th>거래처명</th>
            <th>상태</th>
            <th>기능</th>
          </tr>
          @foreach($company as $c)
          <tr>
            <td><img src="{{env('AWS_S3_URL')}}/company/{{$c->ci}}" style="width:100px;"></td>
            <td>{{ $c->name }}</td>
            <td>
              @if ($c->status == 'Y')
                영업중
              @else
                영업종료
              @endif
            </td>
            <td>
              <a href="{{ url('company/edit/'.$c->id) }}">
                <button type="submit" class="btn btn-primary">상세보기</button>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="pull-right"> {!! $company->render() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection

