@extends('layout.app')
@section('contents')
    @include('layout._errors')

    <form class="form-horizontal" method="post" action="{{ route('admins.update',[$admin]) }}">
        <div class="form-group">
            <label>名字</label>
            <input type="text" class="form-control" id="inputEmail3" name="old_password" value="{{ $admin->name }}" readonly>
        </div>
        <div class="form-group">
            <label>角色选择</label>
            <div class="checkbox">
                @foreach($roles as $role)
                    <label>
                        <input type="checkbox" value="{{ $role->name }}" @if($admin->hasRole($role->name))checked @endif name="role[]" >
                        {{ $role->name }}
                    </label>
                @endforeach
            </div>
        </div>
        {{ csrf_field() }}
        {{ method_field('patch') }}
        <div class="form-group" style="text-align: center">
            <button type="submit" class="btn btn-success">提交</button>
        </div>
        <br>
        <br>
        <br>
    </form>
    @endsection
