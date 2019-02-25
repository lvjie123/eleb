@extends('layout.app3')

@section('contents')
<!--表单-->
@include('layout._errors')
<br>
<br>
<h1>商家注册</h1>
<br>
<br>
<div class="row">
    <form action="{{ route('shop.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">商家名称</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" style="width: 400px">
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">商家邮箱</label>
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" style="width: 400px">
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">商家密码</label>
                <input type="password" class="form-control" name="password" style="width: 400px">
            </div>
        </div>

        <div class="col-md-6">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">店铺分类</label>
                    <select class="form-control" style="width: 400px" name="shop_category_id">
                        @foreach($shop_categories as $shop_categorie)
                        <option value="{{ $shop_categorie->id }}">{{ $shop_categorie->name }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">店铺名称</label>
                    <input type="text" class="form-control" placeholder="请输入店铺名称" name="shop_name" value="{{ old('shop_name') }}" style="width: 400px">
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">店铺图片</label>
                    <input type="file" name="shop_img">
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label" style="width: 200px">是否是品牌</label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="brand" id="inlineRadio1" value="1" @if(old('brand')==1) checked @endif> 是
                    </label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="brand" id="inlineRadio2" value="0" @if(old('brand')==0) checked @endif> 否
                    </label>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label" style="width: 200px">是否准时送达</label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="on_time" id="inlineRadio1" value="1" @if(old('on_time')==1) checked @endif> 是
                    </label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="on_time" id="inlineRadio2" value="0" @if(old('on_time')==0) checked @endif> 否
                    </label>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label" style="width: 200px">是否蜂鸟配送</label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="fengniao" id="inlineRadio1" value="1" @if(old('fengniao')==1) checked @endif> 是
                    </label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="fengniao" id="inlineRadio2" value="0" @if(old('fengniao')==0) checked @endif> 否
                    </label>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label" style="width: 200px">是否保标记</label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="bao" id="inlineRadio1" value="1" @if(old('bao')==1) checked @endif> 是
                    </label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="bao" id="inlineRadio2" value="0" @if(old('bao')==0) checked @endif> 否
                    </label>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label" style="width: 200px">是否票标记</label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="piao" id="inlineRadio1" value="1" @if(old('piao')==1) checked @endif> 是
                    </label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="piao" id="inlineRadio2" value="0" @if(old('piao')==0) checked @endif> 否
                    </label>
                </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label" style="width: 200px">是否准标记</label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="zhun" id="inlineRadio1" value="1" @if(old('zhun')==1) checked @endif> 是
                    </label>
                    <label class="radio-inline" style="float: left">
                        <input type="radio" name="zhun" id="inlineRadio2" value="0" @if(old('zhun')==0) checked @endif> 否
                    </label>
                </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">起送金额</label>
                <input type="text" class="form-control" name="start_send" value="{{ old('start_send') }}" style="width: 400px">
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">配送费</label>
                <input type="text" class="form-control" name="send_cost" value="{{ old('send_cost') }}" style="width: 400px">
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">店公告</label>
                <textarea class="form-control" rows="3" name="notice" style="width: 400px">{{ old('send_cost') }}</textarea>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">优惠信息</label>
                <textarea class="form-control" rows="3" name="discount" style="width: 400px">{{ old('discount') }}</textarea>
            </div>
        </div>
        {{ csrf_field() }}
        <a href="{{ route('login') }}" class="btn btn-default">返回登录</a>
        <button type="submit" class="btn btn-success">提交</button>
    </form>
</div>
@endsection