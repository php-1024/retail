<div class="row border-bottom">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-info " href="javascript:;"><i class="fa fa-bars"></i> </a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <span class="m-r-sm text-muted welcome-message">
                欢迎登录！
                <strong>

                        {{ $admin_data['role_name'] }}-{{ $admin_data['account'] }}

                </strong>
            </span>
        </li>
        <li>
            <a href="{{ url('zerone/quit') }}">
                <i class="fa fa-sign-out"></i>退出系统
            </a>
        </li>
    </ul>
</div>