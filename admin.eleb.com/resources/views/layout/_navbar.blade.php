<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Blog</a>
        </div>
<?php $navs1=\App\Models\Nav::where('pid','=','0')->get();
$ns1 = \App\Models\Nav::all();
$permissions = \Spatie\Permission\Models\Permission::all();
?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{route('first.index')}}">首页<span class="sr-only">(current)</span></a></li>
                @foreach($navs1 as $nav1)
                <li class="dropdown">
                    @foreach($permissions as $permission)
                    @if($nav1->permission_id==$permission->id && \Illuminate\Support\Facades\Auth::user()->can($permission->name))
                    @if($nav1->pid == 0)
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $nav1->name }}<span class="caret"></span></a>
                    @endif
                        <ul class="dropdown-menu">
                            @foreach($ns1 as $n1)
                                @if($n1->pid == $nav1->id)
                                    <li><a href="{{ route("$n1->url") }}">{{ $n1->name }}</a></li>
                                @endif
                                @endforeach
                    </ul>
                </li>
                    @endif
                    @endforeach
                    @endforeach
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="请输入搜索关键字">
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('login') }}">登录</a></li>
                @endguest
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            {{ auth()->user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admins.edits') }}">修改密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}">退出登录</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>