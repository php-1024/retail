<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    	<span>
                            <img alt="image"  src="{{asset('public/Tooling')}}/images/zerone_logo.png" />
                         </span>

                </div>
                <div class="logo-element">
                    01
                </div>
            </li>
            <li @if ($action_name=='system')class="active"@endif>
                <a href="javascript:;"><i class="fa fa-th-large"></i> <span class="nav-label">系统管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if ($route_name=='tooling')class="active"@endif><a href="{{ url('tooling') }}">管理首页</a></li>
                    @if($admin_data['admin_is_super']==1)
                    <li @if ($route_name=='tooling/dashboard/account_add')class="active"@endif><a href="{{ url('tooling/dashboard/account_add') }}">添加账号</a></li>
                    <li @if ($route_name=='tooling/dashboard/account_list')class="active"@endif><a href="{{ url('tooling/dashboard/account_list') }}">账号列表</a></li>
                    <li @if ($route_name=='tooling/dashboard/operation_log')class="active"@endif><a href="{{ url('tooling/dashboard/operation_log') }}">所有操作记录</a></li>
                    <li @if ($route_name=='tooling/dashboard/login_log')class="active"@endif><a href="{{ url('tooling/dashboard/login_log') }}">所有登录记录</a></li>
                    @endif
                </ul>
            </li>
            <li @if ($action_name=='personal')class="active"@endif>
                <a href="javascript:;"><i class="fa fa-user"></i> <span class="nav-label">个人中心</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if ($route_name=='tooling/personal/password_edit')class="active"@endif><a href="{{ url('tooling/personal/password_edit') }}">登录密码修改</a></li>
                    <li @if ($route_name=='tooling/personal/operation_log')class="active"@endif><a href="{{ url('tooling/personal/operation_log') }}">我的操作日志</a></li>
                    <li @if ($route_name=='tooling/personal/login_log')class="active"@endif><a href="{{ url('tooling/personal/login_log') }}">我的登录日志</a></li>
                </ul>
            </li>

            <li @if ($action_name=='program')class="active"@endif>
                <a href="javascript:;"><i class="fa fa-language"></i> <span class="nav-label">程序管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if ($route_name=='tooling/program/program_add')class="active"@endif><a href="{{ url('tooling/program/program_add') }}">添加程序</a></li>
                    <li @if ($route_name=='tooling/program/program_list' || $route_name == 'tooling/program/menu_list')class="active"@endif><a href="{{ url('tooling/program/program_list') }}">程序列表</a></li>
                </ul>
            </li>
            <li @if ($action_name=='module')class="active"@endif>
                <a href="javascript:;"><i class="fa fa-slack"></i> <span class="nav-label">功能模块管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if ($route_name=='tooling/module/module_add')class="active"@endif><a href="{{ url('tooling/module/module_add') }}">添加模块</a></li>
                    <li @if ($route_name=='tooling/module/module_list')class="active"@endif><a href="{{ url('tooling/module/module_list') }}">模块列表</a></li>
                </ul>
            </li>
            <li  @if ($action_name=='node')class="active"@endif>
                <a href="javascript:;"><i class="fa fa-steam"></i> <span class="nav-label">功能节点管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if ($route_name=='tooling/node/node_add')class="active"@endif><a href="{{ url('tooling/node/node_add') }}">添加节点</a></li>
                    <li @if ($route_name=='tooling/node/node_list')class="active"@endif><a href="{{ url('tooling/node/node_list') }}">节点列表</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('tooling/quit') }}"><i class="fa fa-sign-out"></i> <span class="nav-label">退出登录</span></a>
            </li>


        </ul>

    </div>
</nav>