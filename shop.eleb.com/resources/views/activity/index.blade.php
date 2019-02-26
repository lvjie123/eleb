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
        @foreach($activitys as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td>火热进行中</td>

                <td>
                    <a href="{{ route('activity.show',[$activity]) }}" class="btn btn-info">查看</a>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $activitys->appends(['keyword'=>$keyword])->links() }}
    @stop