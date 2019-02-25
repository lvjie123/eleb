@include('layout._head')

<div class="container">
    @include('layout._notice')
    <div class="modal-content" style="text-align: center">
    @yield('contents')
        </div>
</div>

@include('layout._foot')