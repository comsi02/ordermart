@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">거래처 선택</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th>거래처명</th>
            <th>선택</th>
          </tr>
          @foreach($data['company'] as $c)
          <tr>
            <td>{{ $c->name }}</td>
            <td>
              <a href="{{ url('order/person/'.$c->id) }}">
                <button type="submit" class="btn btn-primary btn-xs">선택</button>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="pull-right"> {!! $data['company']->render() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection

