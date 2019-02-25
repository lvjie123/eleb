@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')

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
        <label>菜品图片</label>
        <input type="file" name="goods_img">
    </div>
    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection