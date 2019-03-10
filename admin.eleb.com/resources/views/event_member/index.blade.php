@extends('layout.app')

@section('contents')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>商家名称</th>
        </tr>
        @foreach($event_members as $event_member)
            <tr>
                <td>{{ $event_member->id }}</td>
                <td>{{ $event_member->event->title }}</td>
                <td>{{ $event_member->user->name }}</td>
            </tr>
            @endforeach
    </table>
    {{ $event_members->links() }}
    @stop