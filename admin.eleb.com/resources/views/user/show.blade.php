@extends('layout.app')
@section('contents')
    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">商户名称</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" value="{{ $user->name }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">商户邮箱</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" value="{{ $user->email }}" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">商户状态</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" value="@if($user->status==1)正常@else禁用@endif" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="inputText3" class="col-sm-2 control-label">所属商家</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" value="{{ $user->shop->shop_name }}" readonly>
            </div>
        </div>

    </form>
    @endsection
