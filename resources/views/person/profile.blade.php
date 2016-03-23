@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">내 정보</h3>
      </div>
      <div class="box-body">
        <form method="post" enctype="multipart/form-data" action="{{ URL::route('profile_submit') }}">
        <table class="table table-bordered">
          <tr>
            <th width="20%;">항목</th>
            <th width="80%;">내용</th>
          </tr>
          <tr>
            <td>이미지</td>
            <td>
                <div id="imagePreview">
                  @if ($data['person']['image'])
                    <img src="{{env('AWS_S3_URL')}}/person/{{$data['person']['image']}}" style="width:140px;height:140px;">
                  @else
                    <img src="{{ Asset::version('dist/img/avatar5.png') }}" style="width:140px;height:140px;">
                  @endif
                </div>
                <input type="file" name="image" id="image" onchange="InputImage()">
            </td>
          </tr>
          <tr>
            <td>이름</td>
            <td><input type="text" class="form-control" value="{{$data['person']['name']}}" disabled></td>
          </tr>
          <tr>
            <td>E-Mail</td>
            <td><input type="text" class="form-control" value="{{$data['person']['email']}}" disabled></td>
          </tr>
          <tr>
            <td>권한</td>
            <td>
              <input type="checkbox" id="auth_admin" value="Y" @if ($data['person']['admin_yn'] == 'Y') checked @else disabled @endif>
              <label for="auth_admin">관리자</label><br>

              <input type="checkbox" id="auth_salesman" value="Y" @if ($data['person']['salesman_yn'] == 'Y') checked @else disabled @endif>
              <label for="auth_salesman">영업사원</label><br>

              <input type="checkbox" id="auth_client" value="Y" @if ($data['person']['client_yn'] == 'Y') checked onClick="return false;" @else disabled @endif >
              <label for="auth_client">고객</label><br>
            </td>
          </tr>
          <tr>
            <td>거래처</td>
            <td>
                @if($data['person']->company['name'])
                    {{$data['person']->company['name']}}
                @else
                    <strong>소속</strong> 및 <strong>권한</strong> 변경을 위해서는 <a href="mailto:kordermart@gmail.com">kordermart@gmail.comt</a> 으로 메일 발송 부탁 드립니다.
                @endif
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
