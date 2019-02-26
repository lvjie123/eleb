@extends('layout.app')
@section('contents')

<table class="table" style="text-align: center">
    <tr>
        <td>ID</td>
        <td>商品分类</td>
        <td>分类图片</td>
        <td>分类状态</td>
        <td>操作</td>
    </tr>
    @foreach($shop_categories as $shop_categorie)
        <tr>
            <td>{{ $shop_categorie->id }}</td>
            <td>{{ $shop_categorie->name }}</td>
            <td><img src="{{ $shop_categorie->img }}" style="width: 150px;height: 150px"></td>
            <td>@if($shop_categorie->status==1)显示@else隐藏@endif</td>
            <td>
            <a href="{{ route('shop_categorie.edit',[$shop_categorie]) }}" class="btn btn-info">修改</a>
                <form style="display: inline" method="post" action="{{ route('shop_categorie.destroy',[$shop_categorie]) }}">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                    <button type="submit" class="btn btn-danger">删除</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $shop_categories->links() }}
    @endsection
