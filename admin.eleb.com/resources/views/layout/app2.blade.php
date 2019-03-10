@include('layout._head')

<div class="container">
    @include('layout._notice')
    @yield('contents')
</div>

@include('layout._foot')