@include('layout._head2')

<div class="container" style="width: 600px">
    @include('layout._notice')
    <div class="modal-content" style="text-align: center">
    @yield('contents')
        </div>
</div>

@include('layout._foot')