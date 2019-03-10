@extends('layout.app')

@section('contents')
    <form class="form-inline" action="{{ route('permission.index') }}" method="get">
        <div class="form-group">
            <input type="text" name="keyword" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">搜索</button>
    </form>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>权限名称</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    <form style="display: inline" method="post" action="{{ route('permission.destroy',[$permission]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $permissions->appends(['keyword'=>$keyword])->links() }}
    @stop