@extends('layout.app')

@section('contents')

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>用户名</th>
            {{--<th>操作</th>--}}
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>

                {{--<td><a href="{{ route('admins.show',[$admin]) }}" class="btn btn-info">查看</a>--}}
                    {{--<a href="{{ route('admins.edit',[$admin]) }}" class="btn btn-warning">编辑</a>--}}
                    {{--<form style="display: inline" method="post" action="{{ route('admins.destroy',[$admin]) }}">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--{{ method_field('delete') }}--}}
                        {{--<button type="submit" class="btn btn-danger">删除</button>--}}
                    {{--</form>--}}
                     {{--</td>--}}
            </tr>
            @endforeach
    </table>

    @stop