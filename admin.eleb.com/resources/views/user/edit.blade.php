@extends('layout.app')
@section('contents')
    @include('layout._errors')
    <form class="form-horizontal" method="post" action="{{ route('user.update',[$user]) }}">
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">输入新密码</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="inputEmail3" name="password">
            </div>
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="form-group" style="text-align: center">
            <button type="submit" class="btn btn-success">提交</button>
        </div>
    </form>
    @endsection
