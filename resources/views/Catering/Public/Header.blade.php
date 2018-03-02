<div class="navbar-header aside bg-success dk">
    <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
        <i class="icon-list"></i>
    </a>
    <a href="index.html" class="navbar-brand text-lt">
        <i class="fa fa-cloud"></i>

        <span class="hidden-nav-xs m-l-sm">ZERONE</span>
    </a>
    <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
        <i class="icon-settings"></i>
    </a>
</div>
<ul class="nav navbar-nav hidden-xs">
    <li>
        <a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
            <i class="fa fa-indent text"></i>
            <i class="fa fa-dedent text-active"></i>
        </a>
    </li>
</ul>
<div class="navbar-right ">
    <ul class="nav navbar-nav m-n hidden-xs nav-user user">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle bg clear" data-toggle="dropdown">
                <i class="icon icon-user"></i>
                {{ $admin_data['role_name'] }}-{{ $admin_data['account'] }}<b class="caret"></b>
            </a>
            <ul class="dropdown-menu animated fadeInRight">
                <li>
                    <span class="arrow top"></span>
                    <a href="#"></a>
                </li>
                @if($admin_data['is_super'] == 2)
                <li>
                    <a href="{{url('catering/switch_status')}}">切换商铺</a>
                </li>
                @endif
                <li>
                    <a href="profile.html">账号信息</a>
                </li>

                <li>
                    <a href="password.html">修改密码</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{ url('catering/quit') }}" >退出登录</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
