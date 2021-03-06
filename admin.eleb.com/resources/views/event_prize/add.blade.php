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


<form action="{{route('event_prize.store')}}" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>奖品名称</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
        <label>活动名称</label>
        <select class="form-control" name="events_id">
            <option value="0">请选择活动</option>
            @foreach($events as $event)
                <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>奖品详情</label>
        <script id="container" name="description" type="text/plain"></script>
    </div>

    {{ csrf_field() }}
    <button type="submit" class="btn btn-success">提交</button>
</form>
@endsection