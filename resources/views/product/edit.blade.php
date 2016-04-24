@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">상품수정</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <form method="post" enctype="multipart/form-data" action="{{ URL::route('product_edit_submit') }}" id="product_create_submit">
        <input type="hidden" name="product_id" value="{{$data['product']['id']}}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>사진</td>
            <td>
              <div id="imagePreview">
                <img id="" src="{{env('AWS_S3_URL')}}/product/{{$data['product_image']}}" style="width:{{720/3}}px;height:{{405/3}}px;">
              </div>

              <!-- http://hayageek.com/docs/jquery-upload-file.php -->
              <div id="fileuploader">Upload</div>
              <div id="eventsmessage"></div>
            </td>
          </tr>
          <tr>
            <td>상품ID</td>
            <td>{{$data['product']['id']}}</td>
          </tr>
          <tr>
            <td>상품명</td>
            <td><input type="text" class="form-control" name="name" value="{{$data['product']['name']}}"></td>
          </tr>
          <tr>
            <td>상품설명</td>
            <td><textarea class="form-control" rows="10" name="desc">{{$data['product']['desc']}}</textarea></td>
          </tr>
          <tr>
            <td>판매가능수량</td>
            <td><input type="number" class="form-control" name="quantity" value="{{$data['product']['quantity']}}"></td>
          </tr>
          <tr>
            <td>영업사원</td>
            <td>{{$data['product']->salesman['name']}}</td>
          </tr>
        </table>
        <div class="box-footer">
            <button type="button" class="btn btn-danger" id="product_destory">삭제</button>
            <button type="submit" class="btn btn-primary pull-right">수정</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')

<!-- http://hayageek.com/docs/jquery-upload-file.php -->
<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.10/jquery.uploadfile.min.js"></script>

<script>
    $('#product_destory').on('click',function(){
        $.post( '/product/destory', { 'product_id':"{{$data['product']['id']}}" }, function(data) {
            if (data.result == 'success') {
                window.history.back();
            }
        });
    });

    // http://hayageek.com/docs/jquery-upload-file.php
    $("#fileuploader").uploadFile({
        url:"/common/s3_file_upload",
        fileName:"myfile",
        uploadStr:"파일첨부",
        multiple:false,
        dragDropStr: "<span><b>첨부할 파일을 올려 놓으세요.</b></span>",
        acceptFiles:"image/*",
        showPreview:false,
        maxFileCount:5,
        maxFileSize:10000*1024,
        onSelect:function(files) {
            $(".ajax-file-upload-statusbar").fadeOut(1000);
        },
        onSuccess:function(files,data,xhr,pd)
        {
            if (xhr.responseJSON.success) {
                var html  = '';
                    html += '<input type="hidden" name="image[]" value="'+xhr.responseJSON.filename+'">'
                    html += '<img id="" src="{{env('AWS_S3_URL')}}/product/'+xhr.responseJSON.filename+'" style="width:{{720/3}}px;height:{{405/3}}px;">';
                $("#imagePreview").html($("#imagePreview").html()+html);

                $("#eventsmessage").html("<strong>파일 업로드가 성공 하였습니다.</strong>");
                $("#eventsmessage").show();
            } else {
                $("#eventsmessage").html('<strong class="text-red">파일 업로드가 실패 하였습니다.</strong>');
                $("#eventsmessage").show();
            }
        },
    });

</script>
@endsection
