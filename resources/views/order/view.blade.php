@extends('layouts.app')

@section('content')

<div class="panel-heading">Products - Edit</div>
<div class="panel-body">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{$data['product']['name']}}" disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Desc</label>
    
            <div class="col-sm-10">
                <input type="text" class="form-control" name="desc" value="{{$data['product']['desc']}}" disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Quantity</label>

            <div class="col-sm-10">
                <input type="number" class="form-control" name="quantity" value="{{$data['product']['quantity']}}" disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Salesman</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="salesman" value="{{Auth::user()->name}}" disabled>
            </div>
        </div>
</div>

@endsection
