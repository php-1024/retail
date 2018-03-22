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
            <li @if(in_array($route_name,explode(',',$val['menu_routes_bind']))) class="active" @endif>
                <a href="javascript:;"><i class="{{ $val['icon_class'] }}"></i> <span class="nav-label">{{ $val['menu_name'] }}</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @foreach($son_menu_data[$val['id']] as $k=>$v)
                    <li @if($route_name == $v['menu_route'])class="active"@endif><a href="{{ url($v['menu_route']) }}">{{ $v['menu_name'] }}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach
            <li>
                <a href="{{ url('zerone/quit') }}"><i class="fa fa-sign-out"></i> <span class="nav-label">退出登录</span></a>
            </li>


        </ul>

    </div>
</nav>