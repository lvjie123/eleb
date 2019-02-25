@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')
<form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>分类名称</label>
        <input type="text" class="form-control" placeholder="请输入分类名称" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label>分类描述</label>
        <textarea class="form-control" rows="3" name="description">{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label>是否为默认菜单</label>
        <label class="radio-inline">
            <input type="radio" name="is_selected" id="inlineRadio1" value="1" @if(old('is_selected')==1) checked @endif> 是
        </label>
        <label class="radio-inline">
            <input type="radio" name="is_selected" id="inlineRadio2" value="0" @if(old('is_selected')==0) checked @endif> 否
        </label>
    </div>

    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection