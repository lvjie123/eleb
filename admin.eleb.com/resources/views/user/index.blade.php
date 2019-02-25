@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>商户名称</th>
            <th>所属商家</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->shop->shop_name }}</td>
                <td>@if($user->status==1)正常@else禁用@endif</td>

                <td><a href="{{ route('user.show',[$user]) }}" class="btn btn-info">查看</a>
                    @if($user->status==0)
                        <a href="{{ route('user.examine',[$user]) }}" class="btn btn-success">通过</a>
                    @else
                        <a href="{{ route('user.examine',[$user]) }}" class="btn btn-success">禁用</a>
                    @endif
                    <a href="{{ route('user.edit',[$user]) }}" class="btn btn-warning">重置密码</a>
                    <form style="display: inline" method="post" action="{{ route('user.destroy',[$user]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $users->links() }}
    @stop