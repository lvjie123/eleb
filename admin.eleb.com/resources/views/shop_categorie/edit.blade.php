@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')
<form action="{{ route('shop_categorie.update',[$shop_categorie]) }}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>分类名称</label>
        <input type="text" class="form-control" name="name" value="{{ $shop_categorie->name }}">
    </div>
    <div class="form-group">
        <label>分类图片</label>
        <input type="file" name="img">
    </div>
    <div class="form-group">
        <label>分类状态</label>
        <label class="radio-inline">
            <input type="radio" name="status" id="inlineRadio1" value="1" @if($shop_categorie->status==1)checked @endif> 显示
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" id="inlineRadio2" value="0" @if($shop_categorie->status==0)checked @endif> 隐藏
        </label>
    </div>

    {{ csrf_field() }}
    {{ method_field('patch') }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection