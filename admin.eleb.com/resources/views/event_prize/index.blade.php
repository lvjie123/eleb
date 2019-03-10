@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>奖品名称</th>
            <th>所属活动</th>
            <th>奖品详情</th>
            <th>中奖人</th>
            <th>操作</th>
        </tr>
        @foreach($event_prizes as $event_prize)
            <tr>
                <td>{{ $event_prize->id }}</td>
                <td>{{ $event_prize->name }}</td>
                <td>{{ $event_prize->event->title }}</td>
                <td>{!! $event_prize->description !!}</td>
                <td>@if($event_prize->member_id==0)未开奖 @endif</td>

                <td>
                    <a href="{{ route('event_prize.edit',[$event_prize]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('event_prize.destroy',[$event_prize]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $event_prizes->links() }}
    @stop