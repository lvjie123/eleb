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


<form action="{{route('nav.update',[$nav])}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>菜单名称</label>
        <input type="text" class="form-control" name="name" value="{{ $nav->name }}">
    </div>
    <div class="form-group">
        <label>上级菜单</label>
        <select class="form-control" name="pid" @if($nav->pid==0)disabled @endif>
            <option value="0">顶级菜单</option>
            @foreach($navs as $n)
            <option value="{{ $n->id }}" @if($n->id==$nav->pid)selected @endif>{{ $n->name }}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>地址路由</label>
        <input type="text" class="form-control" name="url" value="{{ $nav->url }}">
    </div>
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection