@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">사용자 관리</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th>ID</th>
            <th>이름</th>
            <th>권한</th>
            <th>소속</th>
            <th>기능</th>
          </tr>
          @foreach($person as $p)
          <tr>
            <td>{{ $p->id }}</td>
            <td>
              {{ $p->name }}<br>
            </td>
            <td>
              @if ($p->admin_yn == 'Y') 관리자<br> @endif
              @if ($p->salesman_yn == 'Y') 영업사원<br> @endif
              @if ($p->client_yn == 'Y') 고객<br> @endif
            </td>
            <td>{{$p->company['name']}}</td>
            <td>
              <a href="{{ url('person/edit/'.$p->id) }}">
                <button type="submit" class="btn btn-primary">상세보기</button>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="pull-right"> {!! $person->render() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection

