@extends('layout.app')
@section('contents')

<table class="table" style="text-align: center">
    <tr>
        <td>ID</td>
        <td>店铺名称</td>
        <td>店铺分类</td>
        <td>店铺图片</td>
        <td>评分</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    @foreach($shops as $shop)
        <tr>
            <td>{{ $shop->id }}</td>
            <td>{{ $shop->shop_name }}</td>
            <td>{{ $shop->shop_categorie->name }}</td>
            <td><img src="{{ $shop->shop_img }}" style="width: 150px;height: 150px"></td>
            <td>{{ $shop->shop_rating }}</td>
            <td>@if($shop->status==1)正常@else未审核@endif</td>
            <td>
                <a href="{{ route('shop.show',[$shop]) }}" class="btn btn-info">查看</a>
                @if($shop->status==0)
                <a href="{{ route('shops.examine',[$shop]) }}" class="btn btn-success">通过</a>
                @else
                    <a href="{{ route('shops.examine',[$shop]) }}" class="btn btn-success">禁用</a>
                @endif
                <a href="{{ route('shop.edit',[$shop]) }}" class="btn btn-warning">修改</a>
                <form style="display: inline" method="post" action="{{ route('shop.destroy',[$shop]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $shops->links() }}
    @endsection
