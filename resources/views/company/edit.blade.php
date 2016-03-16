@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">거래처 수정</h3>
      </div>
      <div class="box-body">
        <form method="post" enctype="multipart/form-data" action="{{ URL::route('company_edit_submit') }}" id="company_create_submit">
        <input type="hidden" name="company_id" value="{{$data['company']['id']}}">
        <table class="table table-bordered">
          <tr>
            <th>항목</th>
            <th>내용</th>
          </tr>
          <tr>
            <td>ID</td>
            <td>{{$data['company']['id']}}</td>
          </tr>
          <tr>
            <td>CI</td>
            <td>
                <div id="imagePreview">
                    <img id="company_ci_img" src="{{env('AWS_S3_URL')}}/company/{{$data['company']['ci']}}" style="width:140px;height:140px;">
                </div>
                <input type="file" name="image" id="image" onchange="InputImage()">
            </td>
          </tr>
          <tr>
            <td>거래처명</td>
            <td><input type="text" class="form-control" name="name" value="{{$data['company']['name']}}"></td>
          </tr>
          <tr>
            <td>상태</td>
            <td>
              <input type="radio" name="status_group" id="status_y" value="Y" @if ($data['company']['status'] == 'Y') checked @endif><label for="status_y">영업중</label><br>
              <input type="radio" name="status_group" id="status_n" value="N" @if ($data['company']['status'] == 'N') checked @endif><label for="status_n">영업종료</label>
            </td>
          </tr>
        </table>
        <div class="box-footer">
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
@endsection
