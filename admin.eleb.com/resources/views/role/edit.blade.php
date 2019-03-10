@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')
@include('vendor.ueditor.assets')

{{--<script type="text/javascript">--}}
    {{--var ue = UE.getEditor('container');--}}
    {{--ue.ready(function() {--}}
        {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.--}}
    {{--});--}}
{{--</script>--}}


<form action="{{ route('role.update',[$role]) }}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>角色名称</label>
        <input type="text" class="form-control" name="name" value="{{ $role->name }}">
    </div>
    <div class="form-group">
        <label>权限选择</label>
        <div class="checkbox">
            @foreach($permissions as $permission)
            <label>
                <input type="checkbox" value="{{ $permission->name }}" @if($role->hasPermissionTo($permission->name))checked @endif name="permission[]" >
                {{ $permission->name }}
            </label>
                @endforeach
        </div>
    </div>
    {{ csrf_field() }}
    {{ method_field('patch') }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection