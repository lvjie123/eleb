@extends('layout.app')
@section('contents')
    @include('layout._errors')
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('shop.update',[$shop]) }}">
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">店铺名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="{{ $shop->shop_name }}" name="shop_name">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店铺分类</label>
            <div class="col-sm-10">
                <select class="form-control" name="shop_category_id">
                    @foreach($shop_categories as $shop_categorie)
                        <option value="{{ $shop_categorie->id }}" @if($shop_categorie->id==$shop->shop_category_id)selected @endif>{{ $shop_categorie->name }}</option>
                    @endforeach
                </select>
            </div>
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
            <label for="inputEmail3" class="col-sm-2 control-label">是否品牌</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="brand" id="inlineRadio1" value="1" @if($shop->brand==1) checked @endif> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="brand" id="inlineRadio2" value="0" @if($shop->brand==0) checked @endif> 否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否准时送达</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="on_time" id="inlineRadio1" value="1" @if($shop->on_time==1) checked @endif> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="on_time" id="inlineRadio2" value="0" @if($shop->on_time==0) checked @endif> 否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否蜂鸟配送</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="fengniao" id="inlineRadio1" value="1" @if($shop->fengniao==1) checked @endif> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="fengniao" id="inlineRadio2" value="0" @if($shop->fengniao==0) checked @endif> 否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否保标记</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="bao" id="inlineRadio1" value="1" @if($shop->bao==1) checked @endif> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="bao" id="inlineRadio2" value="0" @if($shop->bao==0) checked @endif> 否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否票标记</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="piao" id="inlineRadio1" value="1" @if($shop->piao==1) checked @endif> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="piao" id="inlineRadio2" value="0" @if($shop->piao==0) checked @endif> 否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">是否准标记</label>
            <div class="col-sm-10">
                <label class="radio-inline">
                    <input type="radio" name="zhun" id="inlineRadio1" value="1" @if($shop->zhun==1) checked @endif> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="zhun" id="inlineRadio2" value="0" @if($shop->zhun==0) checked @endif> 否
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">起送金额</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="{{ $shop->start_send }}" name="start_send">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="{{ $shop->send_cost }}" name="send_cost">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">店公告</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="notice">{{ $shop->notice }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="discount">{{ $shop->discount }}</textarea>
            </div>
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="form-group" style="text-align: center">
            <button type="submit" class="btn btn-success">提交</button>
        </div>
        <br>
        <br>
        <br>
    </form>
    <script>
        var uploader = WebUploader.create({

// 选完文件后，是否自动上传。
            auto: true,

// swf文件路径
//         swf: BASE_URL + '/js/Uploader.swf',

// 文件接收服务端。
            server: '/upload1',

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
