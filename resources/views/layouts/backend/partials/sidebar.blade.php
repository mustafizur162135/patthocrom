<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <div>
                    <li class="app-sidebar__heading">Dashboard</li>
                        <li>
                            <a href="#" class="#">
                                <i class="metismenu-icon"></i>
                               Dashboard
                            </a>
                        </li>
                    <li class="app-sidebar__heading">User</li>
                        <li>
                            <a href="#" class="#">
                                <i class="metismenu-icon"></i>
                               User
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('role')}}" class="#">
                                <i class="metismenu-icon"></i>
                               Role
                            </a>
                        </li>
                        <li class="app-sidebar__heading">Class</li>
                        <li>
                            <a href="{{ route('admin.class') }}" class="#">
                                <i class="metismenu-icon"></i>
                               Class
                            </a>
                        </li>
                        <li class="app-sidebar__heading">Subject</li>
                        <li>
                            <a href="{{ route('admin.subject') }}" class="#">
                                <i class="metismenu-icon"></i>
                                Subject
                            </a>
                        </li>
                    <li class="app-sidebar__heading">Settings</li>
                    <li>
                        <a href="{{ url('admin/setting/form/1') }}" class="#">
                            <i class="metismenu-icon"></i>
                            Settings
                        </a>
                    </li>
                    
                    <li class="app-sidebar__heading">Help</li>
                        <li>
                            <a href="#" class="#">
                                <i class="metismenu-icon"></i>
                               Help
                            </a>
                        </li>
                    <li class="app-sidebar__heading">Logout</li>
                        <li>
                            <a href="#" class="#">
                                <i class="metismenu-icon"></i>
                               Logout
                            </a>
                        </li>
                </div>
            </ul>
        </div>
    </div>
</div>

