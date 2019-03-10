@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')
@include('vendor.ueditor.assets')

<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>


<form action="{{route('nav.store')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>菜单名称</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label>上级菜单</label>
        <select class="form-control" name="pid">
            <option>==请选择上级菜单==</option>
            <option value="0">顶级菜单</option>
            @foreach($navs as $nav)
            <option value="{{ $nav->id }}">{{ $nav->name }}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>地址路由</label>
        <input type="text" class="form-control" name="url" value="{{ old('url') }}">
    </div>
    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection