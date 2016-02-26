@extends('layouts.app')

@section('content')

<div class="panel-heading">Products - Order View</div>
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

        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">구매수량</label>

            <div class="col-sm-10">
                <input type="number" class="form-control" id='item_count' name="item_count">
            </div>
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary" id="product_order">구매하기</button>
        </div>

</div>

@endsection

@section('js')

<script>
    $('#product_order').on('click',function(){

        var item_count = $('#item_count').val();

        $.post( '/order/product', 
                {
                    'product_id':"{{$data['product']['id']}}",
                    'item_count':item_count
                },
                function(data) {
                    if (data.result == 'success') {
                        alert('구매성공');
                    } else {
                        alert('구매실패');
                    }
                }
        );
    });
</script>

@endsection
