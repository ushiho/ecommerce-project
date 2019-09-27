<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ trans('admin.admin') }}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">{{ trans('admin.toggle_navigation') }}</span>
        </a>

        @include('admin.layouts.menu')
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            <img src="{{ url('/design/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
            <p>{{ admin()->user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('admin.online') }}</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="{{ trans('admin.search') }}">
            <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ trans('admin.main_navigation') }}</li>
            <li class="active ">
            <a href=" {{ aurl() }}">
                <i class="fa fa-dashboard"></i> <span>{{ trans('admin.dashboard') }}</span>
            </a>
            </li>
            <li class="treeview">
            <a href="#">
                <i class="fa fa-users"></i>
                <span>{{ trans('admin.admin_accounts') }}</span>
                @if (changeDirection() == 'rtl')
                <span class="pull-left-container">
                    <i class="fa fa-angle-right pull-left"></i>
                </span>
                @else
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                @endif
            </a>
            <ul class="treeview-menu">
                <li><a href=" {{ aurl('control') }} "><i class="fa fa-user"></i>{{ trans('admin.admin_account') }}</a></li>
            </ul>
            </li>
        </ul>
        </section>
        <!-- /.sidebar -->
    </aside>