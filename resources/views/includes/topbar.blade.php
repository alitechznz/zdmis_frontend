<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="{{ route('/dashboard') }}"><img class="img-fluid for-light"
                        src="../assets/images/logo/logo-1.png" alt=""><img class="img-fluid for-dark"
                        src="../assets/images/logo/logo.png" alt=""></a></div>
            <div class="toggle-sidebar">
                <svg class="sidebar-toggle">
                    <use href="../assets/svg/icon-sprite.svg#stroke-animation"></use>
                </svg>
            </div>
        </div>
        <div class="left-header col-xxl-5 col-xl-6 col-md-4 col-auto box-col-6 horizontal-wrapper p-0">
            <div class="left-menu-header">
                <ul class="header-left">
                    <li>
                        <div class="form-group w-100">
                            <div class="Typeahead Typeahead--twitterUsers">
                                <div class="u-posRelative d-flex">
                                    <svg class="search-bg svg-color me-2">
                                        <use href="../assets/svg/icon-sprite.svg#fill-search"></use>
                                    </svg>
                                    <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100"
                                        type="text" placeholder="Search anything..." name="q" title="">
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        <div class="nav-right col-xxl-7 col-xl-6 col-auto box-col-6 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
                <li class="serchinput">
                    <div class="serchbox">
                        <svg>
                            <use href="../assets/svg/icon-sprite.svg#fill-search"></use>
                        </svg>
                    </div>
                    <div class="form-group search-form">
                        <input type="text" placeholder="Search here...">
                    </div>
                </li>

                <li>
                    <div class="gtranslate_wrapper"></div>
                </li>
                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <svg>
                            <use href="../assets/svg/icon-sprite.svg#fill-Bell"></use>
                        </svg><span class="badge rounded-pill badge-primary">3</span>
                    </div>
                    <div class="onhover-show-div notification-dropdown">
                        <h6 class="f-18 mb-0 dropdown-title">Notifications</h6>
                        <div class="d-flex align-items-center"><img src="../assets/images/dashboard/user/5.png"
                                alt="">
                            <div class="flex-grow-1 ms-2"><a href="user-profile.html">
                                    <h5>
                                        Ralph Edwards <strong> wants to edit </strong> tetrisly design system</h5>
                                    <span>2hrs Ago</span>
                                </a></div>
                            <div class="flex-shrink-0">
                                <div class="activity-dot-primary"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="mode active">
                        <svg>
                            <use href="../assets/svg/icon-sprite.svg#fill-dark"></use>
                        </svg>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown p-0">
                    <div class="d-flex align-items-center profile-media"><img class="b-r-10 img-40"
                            src="../assets/images/dashboard/profile.png" alt="">
                        <div class="flex-grow-1"><span>Name</span>
                            <p class="mb-0">UI Designer </p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>
                        <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i data-feather="log-out"></i>
                                    logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
        <div class="ProfileCard u-cf">
        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
        <div class="ProfileCard-details">
        <div class="ProfileCard-realName">Admin</div>
        </div>
        </div>
      </script>
        <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
    </div>
</div>
