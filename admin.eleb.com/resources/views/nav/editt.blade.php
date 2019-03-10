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


<form action="{{route('nav.rupdate',[$nav])}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>菜单名称</label>
        <input type="text" class="form-control" name="name" value="{{ $nav->name }}" readonly>
    </div>
    <div class="form-group">
        <label>上级菜单</label>
        <select class="form-control" name="permission_id">
            @foreach($permissions as $permission)
            <option value="{{ $permission->id }}" @if($nav->permission_id==$permission->id)selected @endif>{{ $permission->name }}</option>
                @endforeach
        </select>
    </div>
    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection