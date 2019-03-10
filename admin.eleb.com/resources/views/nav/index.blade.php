@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>菜单名称</th>
            <th>上级名称</th>
            <th>地址路由</th>
            <th>操作</th>
        </tr>
        @foreach($navs as $nav)
            <tr>
                <td>{{ $nav->id }}</td>
                <td>{{ $nav->name }}</td>
                <td>
                    @if($nav->pid==0)顶级菜单 @else
                        @foreach($ns as $n)
                             @if($n->id==$nav->pid){{ $n->name }} @endif
                        @endforeach
                    @endif
                </td>
                <td>{{ $nav->url }}</td>
                <td>
                    <a href="{{ route('nav.edit',[$nav]) }}" class="btn btn-info">修改</a>
                    @if($nav->pid==0)
                        <a href="{{ route('nav.editt',[$nav]) }}" class="btn btn-success">修改权限</a>
                        @endif
                    <form style="display: inline" method="post" action="{{ route('nav.destroy',[$nav]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $navs->links() }}
    @stop