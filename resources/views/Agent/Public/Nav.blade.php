
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            @foreach($menu_data as $key=>$val)
            <li class="sub-menu @if(in_array($route_name,explode(',',$val['menu_routes_bind']))) active @endif ">
                <a href="javascript:;">
                    <i class="{{ $val['icon_class'] }}"></i>
                    <span>{{ $val['menu_name'] }}</span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub">
                    {{--@foreach($son_menu_data[$val->id] as $k=>$v)--}}
                    {{--<li @if($route_name == $v->menu_route) class="active" @endif><a href="{{ url($v->menu_route) }}">{{ $v->menu_name }}</a></li>--}}
                    {{--@endforeach--}}
                    @foreach($son_menu_data[$val['id']] as $k=>$v)
                        <li @if($route_name == $v['menu_route'])class="active" @endif>
                            <a href="{{ url($v['menu_route']) }}" class="auto">
                                <span>{{ $v['menu_name'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
            <li>
                <a href="{{ url('proxy/quit') }}">
                    <i class="icon-power-off"></i>
                    <span>退出登录</span>
                </a>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>



