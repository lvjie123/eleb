@extends('layout.app')

@section('contents')
    <a href="{{ route('member.index') }}" class="btn btn-default">返回</a>
    <br>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>省</th>
            <th>市</th>
            <th>区</th>
            <th>具体地址</th>
            <th>联系电话</th>
            <th>收货人</th>
        </tr>
        @foreach($addresses as $address)
            <tr>
                <td>{{ $address->id }}</td>
                <td>{{ $address->province }}</td>
                <td>{{ $address->city }}</td>
                <td>{{ $address->county }}</td>
                <td>{{ $address->address }}</td>
                <td>{{ $address->tel }}</td>
                <td>{{ $address->name }}</td>
            </tr>
        @endforeach
    </table>
    {{ $addresses->links() }}
    @stop