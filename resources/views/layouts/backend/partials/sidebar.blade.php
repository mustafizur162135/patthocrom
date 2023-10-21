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
                <li>
                    <a href="{{ url('admin/dashboard') }}" class="{{ request()->is('/') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
            
                <li>
                    <a href="#" class="{{ request()->is('user', 'role') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        User Management
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('user') }}" class="{{ request()->is('user') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                users
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('role') }}" class="{{ request()->is('role') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Role
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="{{ request()->is('class', 'subject') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Question Management
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('class') }}" class="{{ request()->is('class') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Class
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('subject') }}" class="{{ request()->is('subject') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i>
                                Subject
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>