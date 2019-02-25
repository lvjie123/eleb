@extends('layout.app')

@section('contents')
    <form class="form-inline" action="{{ route('menus.index') }}" method="get">
        <div class="form-group">
            <select class="form-control" name="keyword">
                <option value="">请选择分类</option>
                @foreach($kk as $k)
                    <option value="{{ $k->id }}">{{ $k->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">搜索</button>
    </form>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>菜品名称</th>
            <th>菜品图片</th>
            <th>所属商家</th>
            <th>所属分类</th>
            <th>价格</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td><img src="{{ $menu->goods_img }}" alt="" style="width: 100px;height: 100px"></td>
                <td>{{ $menu->goods_name }}</td>
                <td>{{ $menu->shop->shop_name }}</td>
                <td>{{ $menu->menu_categorie->name }}</td>
                <td>{{ $menu->goods_price }}</td>
                <td>@if($menu->status==1)上架@else下架@endif</td>

                <td>
                    <a href="{{ route('menus.edit',[$menu]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('menus.destroy',[$menu]) }}">
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