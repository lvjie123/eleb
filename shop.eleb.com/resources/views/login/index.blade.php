@extends('layout.app2')
@section('contents')
    @include('layout._errors')
    <br>
    <br>
    <h1>商家登录</h1>
    <br>
    <br>
    <form action="{{ route('login') }}" method="post" class="form-horizontal" >
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">商家名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="name" style="width: 300px">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">商家密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword3" name="password" style="width: 300px">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">验证码</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="captcha" name="captcha" style="width: 200px">
                <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重">
            </div>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="rememberMe" value="1"> 记住我
            </label>
        </div>
        {{ csrf_field() }}
        <div class="form-group">
                <button type="submit" class="btn btn-default">登录</button>
            <a href="{{ route('shop.create') }}" class="btn btn-default">注册</a>
            <a href="{{ route('first.index') }}" class="btn btn-default">返回</a>
        </div>
    </form>

@endsection
