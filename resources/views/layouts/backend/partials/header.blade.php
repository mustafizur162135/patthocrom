<div class="app-header header-shadow">
    <div class="app-header__logo">
        {{-- <div class="logo-src"></div> --}}
        <div class="navbar-brand">
            <b>Patthokrom</b>
        </div>
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
    <div class="app-header__content">
        <div class="app-header-left">
            <div class="search-wrapper">

                <button class="close"></button>
            </div>
            @if (auth()->guard('admin')->check())
                <ul class="header-menu nav">
                    <li class="dropdown nav-item">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="nav-link-icon pe-7s-shuffle"></i>
                            Visit Site
                        </a>
                    </li>
                </ul>
            @endif
        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    {{-- <img width="42" class="rounded-circle" src="{{ Auth::user()->getFirstMediaUrl('avatar') != null ? Auth::user()->getFirstMediaUrl('avatar') : config('app.placeholder').'160' }}"
                                    alt=""> --}}
                                    <img width="42" class="rounded-circle" src="{{ asset('backend/user.png') }}"
                                        alt="{{ asset('backend/user.png') }}">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                    class="dropdown-menu dropdown-menu-right">
                                    <a tabindex="0" class="dropdown-item" href="#">Settings</a>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</button>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">

                                {{-- {{ $adminUserData['name'] }} --}}

                            </div>
                            <div class="widget-subheading">
                                {{-- @if (isset($adminUserData['roles']) && is_array($adminUserData['roles']))
                                    {{ implode(', ', $adminUserData['roles']) }}
                                @else
                                No roles assigned
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
