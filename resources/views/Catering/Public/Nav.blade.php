    <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
        <!-- nav -->
        <nav class="nav-primary  hidden-xs">
            <ul class="nav" data-ride="collapse">
                @foreach($menu_data as $key=>$val)
                <li @if(in_array($route_name,explode(',',$val['menu_routes_bind']))) class="active" @endif >
                    <a href="jacascript:;" class="auto">
                        <span class="pull-right text-muted">
                          <i class="fa fa-angle-left text"></i>
                          <i class="fa fa-angle-down text-active"></i>
                        </span>
                        <i class="{{ $val['icon_class'] }}">
                        </i>
                        <span class="font-bold">{{ $val['menu_name'] }}</span>
                    </a>
                    <ul class="nav">
                        @foreach($son_menu_data[$val['id']] as $k=>$v)
                        <li @if($route_name == $v['menu_route'] || in_array($route_name,explode(',',$v['menu_routes_bind'])))class="active" @endif>
                            <a href="{{ url($v['menu_route']) }}" class="auto">
                                <i class="fa fa-angle-right text-xs text-info"></i>
                                <span>{{ $v['menu_name'] }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
                <li>
                    <a href="{{ url('catering/quit') }}" class="auto">
                        <i class="icon-logout icon text-danger"></i>
                        <span>退出系统</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- / nav -->
    </div>











