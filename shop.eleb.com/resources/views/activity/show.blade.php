@extends('layout.app')

@section('contents')
<!--表单-->
@include('layout._errors')
@include('vendor.ueditor.assets')

<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>活动名称</label>
        <input type="text" class="form-control" name="title" value="{{$activity->title}}" readonly>
    </div>
    <div class="form-group">
        <label>活动开始时间</label>
        <input type="text" class="form-control" name="start_time" value="{{ $activity->start_time }}" readonly>
    </div>
    <div class="form-group">
        <label>活动结束时间</label>
        <input type="text" class="form-control" name="end_time" value="{{ $activity->end_time }}" readonly>
    </div>
    <div class="form-group">
        <label>活动详情</label>
        <script id="container" name="content" type="text/plain">{{ $activity->content }}</script>
    </div>

    {{ csrf_field() }}
    <a href="{{ route('activity.index') }}" class="btn btn-info">返回</a>
</form>
@endsection