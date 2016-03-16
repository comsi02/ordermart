@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">거래처 등록</h3>
      </div>
      <div class="box-body">
        <form method="post" enctype="multipart/form-data" action="{{ URL::route('company_create_submit') }}">
        <table class="table table-bordered">
          <tr>
            <th>항목</th>
            <th>내용</th>
          </tr>
          <tr>
            <td>CI</td>
            <td>
                <div id="imagePreview">
                </div>
                <input type="file" name="image" id="image" onchange="InputImage()">
            </td>
          </tr>
          <tr>
            <td>거래처명</td>
            <td><input type="text" class="form-control" name="name" placeholder="거래처명"></td>
          </tr>
          <tr>
            <td>상태</td>
            <td>
                <input type="radio" name="status_group" value="Y" checked>영업중
                <input type="radio" name="status_group" value="N">영업완료
            </td>
          </tr>
        </table>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">등록</button>
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
