<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
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
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
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
                        <a href="{{ url('/teacher/dashboard') }}" class="#">
                            <i class="metismenu-icon pe-7s-car"></i>
                            Dashboard
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('teacher.qc_print') }}" class="#">
                            <i class="metismenu-icon fas fa-file-import"></i>
                            Print Question
                        </a>
                    </li>



                    <li>
                        <a href="{{ url('/teacher/buy-package-list') }}" class="#">
                            <i class="metismenu-icon fas fa-box"></i>
                            Package
                        </a>
                    </li>





                </div>
            </ul>
        </div>
    </div>
</div>
