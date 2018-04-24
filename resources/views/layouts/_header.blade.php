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
            <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-home"></span></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="/">首页 <span class="sr-only">(current)</span></a></li>
                <li><a href="{{ route('help') }}">帮助</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('activities.index') }}">查看活动</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('activities.create') }}">添加活动</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">店铺管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('members.index') }}">查看店铺</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('members.create') }}">添加店铺</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商铺分类管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('cats.index') }}">查看商铺分类</a></li>
                        <li><a href="{{ route('cats.create') }}">添加商铺分类</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route('about')}}"><span class="glyphicon glyphicon-info-sign"></span>关于我们</a></li>
                @guest
                <li><a href="{{route('login')}}">登陆</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user">{{\Illuminate\Support\Facades\Auth::user()->name}}</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('admins.edit',['admin'=>\Illuminate\Support\Facades\Auth::user()]) }}" class=""><span class="glyphicon glyphicon-cog"></span>&emsp;修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form method="post" action="{{route('logout')}}">
                                <button class="btn btn-link btn-block"><span class="glyphicon glyphicon-off"></span>注销</button>
                                {{method_field('DELETE')}}
                                {{csrf_field()}}
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

