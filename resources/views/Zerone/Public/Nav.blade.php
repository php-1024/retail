<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    	<span>
                            <img alt="image"  src="{{asset('public/Zerone')}}/images/zerone_logo.png" />
                         </span>

                </div>
                <div class="logo-element">
                    01
                </div>
            </li>
            @foreach($menu_data as $key=>$val)
            <li class="active">
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">{{ $val->menu_name }}</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="active"><a href="{{ url('tooling') }}">管理首页</a></li>
                </ul>
            </li>
            @endforeach
            <li>
                <a href="{{ url('tooling/quit') }}"><i class="fa fa-sign-out"></i> <span class="nav-label">退出登录</span></a>
            </li>


        </ul>

    </div>
</nav>