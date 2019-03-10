@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>联系电话</th>
            <th>收货人</th>
            <th>总金额</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->username }}</td>
                <td>{{ $order->tel }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->total }}</td>
                <td>@if($order->status==-1)已取消 @elseif($order->status==0)待支付 @elseif($order->status==1)待发货 @elseif($order->status==2)待确认 @elseif($order->status==3)完成 @endif</td>
                <td>
                    <a href="{{ route('showorder',[$order]) }}" class="btn btn-success">查看订单</a>
                    @if($order->status==-0 || $order->status==1 || $order->status==2)
                    <a href="{{ route('cancel',[$order]) }}" class="btn btn-danger">取消订单</a>
                        @else
                        <a href="" class="btn btn-danger" disabled="disabled">取消订单</a>
                        @endif
                    @if($order->status==1)
                        <a href="{{ route('cancel1',[$order]) }}" class="btn btn-warning">发货</a>
                        @endif
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $orders->links() }}
    @stop