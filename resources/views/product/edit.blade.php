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
        <form method="post" action="{{ URL::route('product_edit_submit') }}" id="product_create_submit">
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
                <img id="company_ci_img" src="" style="width:140px;height:140px;">
              </div>
              <input type="file" name="image" id="image" onchange="InputImage()">
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
<script>
$('#product_destory').on('click',function(){
    $.post( '/product/destory', { 'product_id':"{{$data['product']['id']}}" }, function(data) {
        if (data.result == 'success') {
            window.history.back();
        }
    });
});

var InputImage = (function loadImageFile() {
    if (window.FileReader) {
        var ImagePre,
            ImgReader = new window.FileReader(),
            fileType = /^(?:image\/bmp|image\/gif|image\/jpeg|image\/png|image\/x\-xwindowdump|image\/x\-portable\-bitmap)$/i;

        ImgReader.onload = function (event) {
            if (!ImagePre) {
                var newPreview = document.getElementById("imagePreview");
                ImagePre = new Image();
                ImagePre.style.width = "140px";
                ImagePre.style.height = "140px";
                newPreview.appendChild(ImagePre);
            }
            ImagePre.src = event.target.result;
        };

        return function () {
            var img = document.getElementById("image").files;
            if (!fileType.test(img[0].type)) {
                alert("이미지 파일을 업로드 하세요");
                return;
            }
            ImgReader.readAsDataURL(img[0]);
        }
    }
    document.getElementById("imagePreview").src = document.getElementById("image").value;
})();

</script>

