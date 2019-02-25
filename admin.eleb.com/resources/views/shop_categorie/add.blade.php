@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')
<form action="{{route('shop_categorie.store')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>分类名称</label>
        <input type="text" class="form-control" placeholder="请输入分类名称" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label>分类图片</label>
        <input type="file" name="img">
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
@endsection