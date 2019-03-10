@extends('layout.app')

@section('contents')
    <form class="form-inline" action="{{ route('member.index') }}" method="get">
        <div class="form-group">
            <input type="text" name="keyword" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">搜索</button>
    </form>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>会员名称</th>
            <th>联系电话</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>@if($member->status==1)正常 @else禁用 @endif</td>
                <td>
                    <a href="{{ route('member.show',[$member]) }}" class="btn btn-info">查看</a>
                    @if($member->status==1)
                    <a href="{{ route('member.examine',[$member]) }}" class="btn btn-danger">禁用</a>
                    @else
                        <a href="{{ route('member.examine1',[$member]) }}" class="btn btn-success">启用</a>
                        @endif
                     </td>
            </tr>
            @endforeach
    </table>
    {{ $members->appends(['keyword'=>$keyword])->links() }}
    @stop