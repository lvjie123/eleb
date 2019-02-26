@extends('layout.app')

@section('contents')
    <form class="form-inline" action="{{ route('activity.index') }}" method="get">
        <div class="form-group">
            <select class="form-control" name="keyword">
                <option value="">请选择分类</option>
                    <option value="1">未进行</option>
                    <option value="2">在进行</option>
                    <option value="3">已结束</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">搜索</button>
    </form>

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
                <td>@if($activity->start_time>date('Y-m-d H:i:s'))未开始
                    @elseif($activity->end_time<date('Y-m-d H:i:s'))已结束
                    @elseif($activity->end_time>date('Y-m-d H:i:s'))在进行
                    @endif</td>

                <td>
                    <a href="{{ route('activity.show',[$activity]) }}" class="btn btn-info">查看</a>
                    <a href="{{ route('activity.edit',[$activity]) }}" class="btn btn-warning">修改</a>
                    <form style="display: inline" method="post" action="{{ route('activity.destroy',[$activity]) }}">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button type="submit" class="btn btn-danger">删除</button>
                    </form>
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $activitys->appends(['keyword'=>$keyword])->links() }}
    @stop