@extends('layout.app')
@section('contents')
    @include('layout._errors')
    <form class="form-horizontal" method="post" action="{{ route('shop.changepassword') }}">
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">输入旧密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputEmail3" name="old_password">
            </div>
        </div>
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">输入新密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputEmail3" name="new_password">
            </div>
        </div>
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">输入新密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputEmail3" name="new_password_confirmation">
            </div>
        </div>

        {{ csrf_field() }}
        <div class="form-group" style="text-align: center">
            <button type="submit" class="btn btn-success">提交</button>
        </div>
        <br>
        <br>
        <br>
    </form>
    @endsection
