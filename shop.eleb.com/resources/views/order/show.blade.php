@extends('layout.app')

@section('contents')
    <a href="{{ route('orderlist') }}" class="btn btn-default">返回</a>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>商品名称</th>
            <th>商品图片</th>
            <th>商品数量</th>
            <th>商品价格</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->goods_name }}</td>
                <td><img src="{{ $order->goods_img }}" alt="" style="width: 50px;height: 50px"></td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->goods_price }}</td>
            </tr>
            @endforeach
    </table>
    {{ $orders->links() }}
    @stop