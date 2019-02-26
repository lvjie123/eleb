
@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
<!--引入JS-->
<script type="text/javascript" src="/webuploader/webuploader.js"></script>

<form action="{{route('shop_categorie.store')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>分类名称</label>
        <input type="text" class="form-control" placeholder="请输入分类名称" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <input type="hidden" id="haha" name="img">
        <img src="" alt="" id="sb">
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
        </div>
    </div>
    <div class="form-group">
        <label>分类状态</label>
        <label class="radio-inline">
            <input type="radio" name="status" id="inlineRadio1" value="1" @if(old('status')==1) checked @endif> 显示
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" id="inlineRadio2" value="0" @if(old('status')==0) checked @endif> 隐藏
        </label>
    </div>

    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
<script>
    var uploader = WebUploader.create({

// 选完文件后，是否自动上传。
        auto: true,

// swf文件路径
        //swf: BASE_URL + '/js/Uploader.swf',

// 文件接收服务端。
        server: '/upload',

// 选择文件的按钮。可选。
// 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',

// 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        },
        formData:{
            _token:'{{ csrf_token() }}'
        }
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file ,response) {
        // console.log(response.path);
        $( '#sb' ).attr('src',response.path).css('width','100px');
        $('#haha').val(response.path);
    });
</script>
@endsection


