@extends('layout.app')

@section('contents')
    <form class="form-inline" action="{{ route('role.index') }}" method="get">
        <div class="form-group">
            <input type="text" name="keyword" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">搜索</button>
    </form>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>角色名称</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a href="{{ route('role.edit',[$role]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('role.destroy',[$role]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $roles->appends(['keyword'=>$keyword])->links() }}
    @stop