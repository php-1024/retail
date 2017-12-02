<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    	<span>
                            <img alt="image"  src="{{asset('public/Program')}}/images/zerone_logo.png" />
                         </span>

                </div>
                <div class="logo-element">
                    01
                </div>
            </li>
            <li @if ($action_name=='system')class="active"@endif>
                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">系统管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if ($route_name=='program')class="active"@endif><a href="{{ url('program') }}">管理首页</a></li>
                    @if($admin_data['admin_is_super']==1)
                    <li @if ($route_name=='program/dashboard/account_add')class="active"@endif><a href="{{ url('program/dashboard/account_add') }}">添加账号</a></li>
                    <li @if ($route_name=='program/dashboard/account_list')class="active"@endif><a href="{{ url('program/dashboard/account_list') }}">账号列表</a></li>
                    <li @if ($route_name=='program/dashboard/operation_log')class="active"@endif><a href="{{ url('program/dashboard/operation_log') }}">所有操作记录</a></li>
                    <li @if ($route_name=='program/dashboard/login_log')class="active"@endif><a href="{{ url('program/dashboard/login_log') }}">所有登陆记录</a></li>
                    @endif
                </ul>
            </li>
            <li @if ($action_name=='personal')class="active"@endif>
                <a href="index.html"><i class="fa fa-user"></i> <span class="nav-label">个人中心</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if ($route_name=='program/personal/edit_password')class="active"@endif><a href="{{ url('program/personal/edit_password') }}">登录密码修改</a></li>
                    <li @if ($route_name=='program/personal/operation_log')class="active"@endif><a href="{{ url('program/personal/operation_log') }}">我的操作日志</a></li>
                    <li @if ($route_name=='program/personal/login_log')class="active"@endif><a href="{{ url('program/personal/login_log') }}">我的登录日志</a></li>
                </ul>
            </li>

            <li>
                <a href="index.html"><i class="fa fa-language"></i> <span class="nav-label">程序管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="addsystem.html">添加程序</a></li>
                    <li><a href="system.html">程序列表</a></li>
                </ul>
            </li>
            <li @if ($action_name=='module')class="active"@endif>
                <a href="index.html"><i class="fa fa-slack"></i> <span class="nav-label">功能模块管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li  @if ($route_name=='program/module/add_module')class="active"@endif><a href="{{ url('program/module/add_module') }}">添加模块</a></li>
                    <li><a href="funcmodule.html">模块列表</a></li>
                </ul>
            </li>
            <li  @if ($action_name=='node')class="active"@endif>
                <a href="index.html"><i class="fa fa-steam"></i> <span class="nav-label">功能节点管理</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if ($route_name=='program/node/add_node')class="active"@endif><a href="{{ url('program/node/add_node') }}">添加节点</a></li>
                    <li @if ($route_name=='program/node/node_list')class="active"@endif><a href="{{ url('program/node/node_list') }}">节点列表</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url('program/quit') }}"><i class="fa fa-sign-out"></i> <span class="nav-label">退出登录</span></a>
            </li>


        </ul>

    </div>
</nav>