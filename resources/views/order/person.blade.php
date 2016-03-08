@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">영업사원 선택</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered">
          <tr>
            <th>영업사원</th>
            <th>선택</th>
          </tr>
          @foreach($data['person'] as $p)
          <tr>
            <td>{{ $p->name }}</td>
            <td>
              <a href="{{ url('order/product/'.$p->id) }}">
                <button type="submit" class="btn btn-primary">선택</button>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
        <div class="pull-right"> {!! $data['person']->render() !!} </div>
      </div>
    </div>
  </div>
</div>
@endsection

