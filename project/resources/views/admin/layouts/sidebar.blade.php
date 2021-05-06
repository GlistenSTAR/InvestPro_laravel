<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title">
            <a href="{{url('/')}}" class="site_title"><i class="fa fa-globe"></i> <span>{{$general->web_name}}</span></a>
        </div>
        <div class="clearfix"></div>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">

                    <li><a href="{{route('admin.home')}}"><i class="fa fa-home"></i> @lang('Dashboard') </a></li>

                    <li><a href="{{route('admin.referral')}}"><i class="fa fa-sitemap"></i> @lang('Manage Referral') </a></li>

                    <li><a><i class="fa fa-credit-card-alt"></i> @lang('Deposit Management') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('gateway')}}">@lang('Gateways')</a></li>
                            <li><a href="{{route('admin.deposit.pending')}}">@lang('Pending Deposit')</a></li>
                            <li><a href="{{route('admin.deposit.acceptedRequests')}}">@lang('Accepted Deposit')</a></li>
                            <li><a href="{{route('admin.deposit.rejectedRequests')}}">@lang('Rejected Deposit')</a></li>
                            <li><a href="{{route('admin.deposit.depositLog')}}">@lang('Deposit Log')</a></li>
                        </ul>
                    </li>


                    <li><a><i class="fa fa-users"></i> @lang('Users Management') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('user.manage')}}">@lang('All Users')</a></li>
                            <li><a href="{{route('active.user.manage')}}">@lang('Active Users')</a></li>
                            <li><a href="{{route('ban.user.manage')}}">@lang('Banned Users')</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-retweet"></i> @lang('Withdraw Management') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('add.withdraw.method')}}">@lang('Methods')</a></li>
                            <li><a href="{{route('withdraw.request.index')}}">@lang('Pending Withdraw')</a></li>
                            <li><a href="{{route('withdraw.viewlog.admin')}}">@lang('Withdraw Log')</a></li>
                        </ul>
                    </li>

                    <li><a href="{{route('transaction.log.admin')}}"><i class="fa fa-list"></i> @lang('Transaction Log') </a></li>

                    <li><a><i class="fa fa-newspaper-o"></i> @lang('News') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('news-area.create')}}">@lang('Add')</a></li>
                            <li><a href="{{route('news-area.index')}}">@lang('Manage')</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-briefcase"></i> @lang('Plan') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('plan-area.create')}}">@lang('Add')</a></li>
                            <li><a href="{{route('plan-area.index')}}">@lang('Manage')</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-bars"></i> @lang('Menus') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('menu-area.create')}}">@lang('Add')</a></li>
                            <li><a href="{{route('menu-area.index')}}">@lang('Manage')</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-globe"></i> @lang('Web Interface') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('banner.index')}}">@lang('Banner')</a></li>
                            <li><a href="{{route('work-area.index')}}">@lang('Work Area')</a></li>
                            <li><a href="{{route('about-area.index')}}">@lang('About')</a></li>
                            <li><a href="{{route('service-area.index')}}">@lang('Services')</a></li>
                            <li><a href="{{route('investor-area.index')}}">@lang('Investors')</a></li>
                            <li><a href="{{route('partner-area.index')}}">@lang('Partners')</a></li>
                            <li><a href="{{route('social-area.index')}}">@lang('Socials')</a></li>
                            <li><a href="{{route('logo-icon.index')}}">@lang('Logo & Icon')</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-cog"></i> @lang('General') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.gnl.set')}}">@lang('Settings')</a></li>
                            <li><a href="{{route('email.index.admin')}}">@lang('Email Template')</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings" href="{{route('admin.gnl.set')}}">
                <span class="fa fa-cog" aria-hidden="true"></span>
            </a>

            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('admin.logout')}}">
                <span class="fa fa-power-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
