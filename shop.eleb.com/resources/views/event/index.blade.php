@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ date('Y-m-d',$event->signup_start) }}</td>
                <td>{{ date('Y-m-d',$event->signup_end) }}</td>
                <td>@if($event->is_prize==0)未开奖 @else已开奖 @endif</td>

                <td>
                    <a href="{{ route('baoming',[$event]) }}" class="btn btn-info">报名</a>
                    <a href="{{ route('event.show',[$event]) }}" class="btn btn-warning">查看</a>
                    {{--<form style="display: inline" method="post" action="{{ route('event.destroy',[$event]) }}">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--{{ method_field('delete') }}--}}
                        {{--<button type="submit" class="btn btn-danger">删除</button>--}}
                    {{--</form>--}}
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $events->links() }}
    @stop