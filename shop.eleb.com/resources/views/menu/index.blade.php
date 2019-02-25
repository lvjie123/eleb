@extends('layout.app')

@section('contents')
    <form class="form-inline" action="{{ route('menu.index') }}" method="get">
        <div class="form-group">
            <input type="text" class="form-control" name="keyword">
        </div>
        <button type="submit" class="btn btn-success">搜索</button>
    </form>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>所属商家</th>
            <th>是否默认</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->shop->shop_name }}</td>
                <td>@if($menu->is_selected==1)默认@else普通@endif</td>

                <td>
                    <a href="{{ route('menu.edit',[$menu]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('menu.destroy',[$menu]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $menus->appends(['keyword'=>$keyword])->links() }}
    @stop