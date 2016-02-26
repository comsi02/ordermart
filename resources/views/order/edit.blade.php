@extends('layouts.app')

@section('content')

<div class="panel-heading">Products - Edit</div>
<div class="panel-body">

    <form method="post" action="{{ URL::route('product_edit_submit') }}" id="product_create_submit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="product_id" value="{{$data['product']['id']}}">

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{$data['product']['name']}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Desc</label>
    
            <div class="col-sm-10">
                <input type="text" class="form-control" name="desc" value="{{$data['product']['desc']}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Quantity</label>

            <div class="col-sm-10">
                <input type="number" class="form-control" name="quantity" value="{{$data['product']['quantity']}}">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Salesman</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" name="salesman" value="{{Auth::user()->name}}" disabled>
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection

