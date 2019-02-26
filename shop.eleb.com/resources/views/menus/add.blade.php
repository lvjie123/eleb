@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
<!--引入JS-->
<script type="text/javascript" src="/webuploader/webuploader.js"></script>
<form action="{{ route('menus.store') }}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>菜品名称</label>
        <input type="text" class="form-control" name="goods_name" value="{{ old('goods_name') }}">
    </div>
    <div class="form-group">
        <select class="form-control" name="category_id">
            <option value="">请选择分类</option>
            @foreach($kk as $k)
                <option value="{{ $k->id }}">{{ $k->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>菜品价格</label>
        <input type="text" class="form-control" name="goods_price" value="{{ old('goods_price') }}">
    </div>
    <div class="form-group">
        <label>菜品描述</label>
        <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label>提示信息</label>
        <textarea class="form-control" rows="3" name="tips">{{ old('tips') }}</textarea>
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
    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
<script>
    var uploader = WebUploader.create({

// 选完文件后，是否自动上传。
        auto: true,

// swf文件路径
//         swf: BASE_URL + '/js/Uploader.swf',

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