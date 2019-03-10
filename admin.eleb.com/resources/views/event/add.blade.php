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


<form action="{{route('event.store')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>活动名称</label>
        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
    </div>
    <div class="form-group">
        <label>活动开始时间</label>
        <input type="date" class="form-control" name="signup_start" min="{{ date('Y-m-d') }}">
    </div>
    <div class="form-group">
        <label>活动结束时间</label>
        <input type="date" class="form-control" name="signup_end" min="{{ date('Y-m-d') }}">
    </div>
    <div class="form-group">
        <label>活动开奖时间</label>
        <input type="date" class="form-control" name="prize_date" min="{{ date('Y-m-d') }}">
    </div>
    <div class="form-group">
        <label>报名人数限制</label>
        <input type="text" class="form-control" name="signup_num" value="{{ old('signup_num') }}">
    </div>
    <div class="form-group">
        <label>详情</label>
        <script id="container" name="content" type="text/plain"></script>
    </div>

    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection