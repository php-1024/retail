{{--<aside class="bg-black dk aside hidden-print" id="nav">--}}
    {{--<section class="vbox">--}}
        {{--<section class="w-f-md scrollable">--}}
            {{--<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px"--}}
                 {{--data-railOpacity="0.2">--}}
                {{--<!-- nav -->--}}
                {{--<nav class="nav-primary hidden-xs">--}}
                    {{--<ul class="nav" data-ride="collapse">--}}
                        {{--@foreach($menu_data as $key=>$val)--}}
                        {{--<li @if(in_array($route_name,explode(',',$val->menu_routes_bind))) class="active" @endif>--}}
                            {{--<a href="javascript:;" class="auto">--}}
                                {{--<span class="pull-right text-muted">--}}
                                  {{--<i class="fa fa-angle-left text"></i>--}}
                                  {{--<i class="fa fa-angle-down text-active"></i>--}}
                                {{--</span>--}}
                                {{--<i class="{{ $val->icon_class }}">--}}
                                {{--</i>--}}
                                {{--<span>{{ $val->menu_name }}</span>--}}
                            {{--</a>--}}
                            {{--<ul class="nav dk text-sm">--}}
                                {{--@foreach($son_menu_data[$val->id] as $k=>$v)--}}
                                    {{--<li @if($route_name == $v->menu_route)class="active"@endif>--}}
                                        {{--<a href="{{ url($v->menu_route) }}" class="auto">--}}
                                            {{--<i class="fa fa-angle-right text-info"></i>--}}
                                            {{--<span>{{ $v->menu_name }}</span>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                        {{--@endforeach--}}
                        {{--<li>--}}
                            {{--<a href="{{ url('company/quit') }}" class="auto">--}}
                                {{--<i class="icon-logout icon text-danger"></i>--}}
                                {{--<span>退出系统</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</nav>--}}
                {{--<!-- / nav -->--}}
            {{--</div>--}}
        {{--</section>--}}
    {{--</section>--}}
{{--</aside>--}}



<aside class="bg-black dk aside hidden-print" id="nav">
    <section class="vbox">
        <section class="w-f-md scrollable">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 192px;"><div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railopacity="0.2" style="overflow: hidden; width: auto; height: 192px;">
                    <!-- nav -->
                    <nav class="nav-primary hidden-xs">
                        <ul class="nav" data-ride="collapse">
                            <li class="active">
                                <a href="javascript:;" class="auto">
                                <span class="pull-right text-muted">
                                  <i class="fa fa-angle-left text"></i>
                                  <i class="fa fa-angle-down text-active"></i>
                                </span>
                                    <i class="icon-screen-desktop icon text-success fa fa-user">
                                    </i>
                                    <span>账户中心</span>
                                </a>
                                <ul class="nav dk text-sm">
                                    <li>
                                        <a href="http://o2o.01nnt.com/company" class="auto">
                                            <i class="fa fa-angle-right text-info"></i>
                                            <span>公司资料</span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="http://o2o.01nnt.com/company/account/profile" class="auto">
                                            <i class="fa fa-angle-right text-info"></i>
                                            <span>账号信息</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://o2o.01nnt.com/company/account/password" class="auto">
                                            <i class="fa fa-angle-right text-info"></i>
                                            <span>登录密码修改</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://o2o.01nnt.com/company/account/safe_password" class="auto">
                                            <i class="fa fa-angle-right text-info"></i>
                                            <span>安全密码设置</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://o2o.01nnt.com/company/account/operation_log" class="auto">
                                            <i class="fa fa-angle-right text-info"></i>
                                            <span>操作日志</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://o2o.01nnt.com/company/account/login_log" class="auto">
                                            <i class="fa fa-angle-right text-info"></i>
                                            <span>登录日志</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;" class="auto">
                                <span class="pull-right text-muted">
                                  <i class="fa fa-angle-left text"></i>
                                  <i class="fa fa-angle-down text-active"></i>
                                </span>
                                    <i class="fa-sitemap fa text-success">
                                    </i>
                                    <span>店铺管理</span>
                                </a>
                                <ul class="nav dk text-sm">
                                    <li>
                                        <a href="http://o2o.01nnt.com/company/store/store_add" class="auto">
                                            <i class="fa fa-angle-right text-info"></i>
                                            <span>创建店铺</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://o2o.01nnt.com/company/store/store_list" class="auto">
                                            <i class="fa fa-angle-right text-info"></i>
                                            <span>管理店铺</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="http://o2o.01nnt.com/company/quit" class="auto">
                                    <i class="icon-logout icon text-danger"></i>
                                    <span>退出系统</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- / nav -->
                </div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 10px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 0px; height: 112.734px;"></div><div class="slimScrollRail" style="width: 10px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div></div>
        </section>
    </section>
</aside>