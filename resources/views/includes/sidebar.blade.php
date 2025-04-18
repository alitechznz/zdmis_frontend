@push('styles')
    <style>
        .bg-active {
            background-color: #56540B !important;
            /* This will change the text color to the specified greenish-yellow when active */
        }
    </style>
@endpush
<div class="sidebar-wrapper" data-layout="fill-svg" style="background: #334628;">
    <div>
        <div class="logo-wrapper">
            <a href="#">
                <img class="img-fluid" src="{{ asset('logo/logo.png') }}" alt="">
            </a>
            <div class="toggle-sidebar">
                {{-- <a href="{{ route('switchLang', 'en') }}"><img src="{{ asset('icons/en.png') }}" alt="English"></a>
                <a href="{{ route('switchLang', 'sw') }}"><img src="{{ asset('icons/sw.png') }}" alt="Swahili"></a> --}}

                <svg class="sidebar-toggle">
                    <use href="../assets/svg/icon-sprite.svg#toggle-icon"></use>
                </svg>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="/">
                <img class="img-fluid" src="{{ asset('logo/logo.png') }}" alt="">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow">
                <i data-feather="arrow-left"></i>
            </div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="/">
                            <img class="img-fluid" src="{{ asset('logo/logo.png') }}" alt="">
                        </a>
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6 style="background: #334628;">Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg>
                            <span>{{ __('menu.dashboard') }}</span>
                        </a>

                    </li>

                    {{-- @canany(['view region', 'view district', 'view shehia']) --}}
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-maps"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-maps"></use>
                            </svg>
                            <span>{{ __('menu.location') }}</span>
                        </a>
                        <ul class="sidebar-submenu">
                            {{-- @can('view region') --}}
                            <li><a href="{{ route('region') }}">{{ __('menu.Region') }}</a></li>
                            {{-- @endcan --}}
                            {{-- @can('view district') --}}
                            <li><a href="{{ route('district') }}">{{ __('menu.District') }}</a></li>
                            {{-- @endcan --}}
                            {{-- @can('view shehia') --}}
                            <li><a href="{{ route('shehia') }}">Shehia</a></li>
                            {{-- @endcan --}}
                        </ul>
                    </li>
                    {{-- @endcanany --}}



                    {{-- @canany(['view ministry', 'view department', 'view institution', 'view rd committee', 'view municipal council', 'view screening question', 'view appraisal question', 'view source of finance', 'view zpc calendar', 'view budget form', 'view unit value', 'view financial particular', 'view sector']) --}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6 style="background: #334628;">{{ __('menu.Setup') }}</h6>
                        </div>
                    </li>
                    {{-- @canany(['view screening question', 'view appraisal question', 'view source of finance', 'view zpc calendar', 'view budget form', 'view unit value', 'view financial particular', 'view sector']) --}}
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-knowledgebase"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-knowledgebase"></use>
                            </svg>
                            <span class="">{{ __('menu.BasicSetup') }}</span>
                        </a>
                        <ul class="sidebar-submenu">
                            {{-- @can('view screening question') --}}
                            
                            <li><a href="">{{ __('menu.basic_setup') }}</a></li>
                            {{-- @endcan --}}
                            {{-- @can('view screening question') --}}
                            {{-- <li><a href="{{ route('disaster-source') }}">{{ __('menu.Hazard_Source') }}</a></li> --}}
                            {{-- @endcan --}}
                            {{-- @can('view appraisal question') --}}
                            {{-- <li><a href="{{ route('disaster-situation') }}">{{ __('menu.Hazard_Status') }}</a></li> --}}
                            {{-- @endcan --}}
                            {{-- @can('view appraisal question') --}}
                            {{-- <li><a href="{{ route('disaster-analysis') }}">{{ __('menu.Hazard_Category') }}</a></li> --}}
                            {{-- @endcan --}}
                            {{-- @can('view appraisal question') --}}
                            {{-- <li><a href="{{ route('weather-source') }}">{{ __('menu.Weather_Source') }}</a></li> --}}
                            {{-- @endcan --}}
                            {{-- @can('view appraisal question') --}}
                            {{-- <li><a href="{{ route('standard') }}">{{ __('menu.Measurement_Unit') }}</a></li> --}}
                            {{-- @endcan --}}

                        </ul>
                    </li>
                    {{-- @endcanany --}}
                    {{-- @canany(['view ministry', 'view institution', 'view department', 'view rd committee', 'view municipal council']) --}}
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title " href="#">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-knowledgebase"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-knowledgebase"></use>
                            </svg>
                            <span class="">M<small>DA</small> / L<small>GA</small>'s Setup</span>
                        </a>
                        <ul class="sidebar-submenu">
                            {{-- @can('view ministry') --}}
                            <li><a href="{{ route('ministry') }}">Ministries</a></li>
                            {{-- @endcan --}}
                            {{-- @can('view institution') --}}
                            <li><a href="{{ route('institutions') }}">Institutions</a></li>
                            {{-- @endcan --}}
                            {{-- @can('view department') --}}
                            <li><a href="{{ route('departments') }}">Departments</a></li>
                            {{-- @endcan --}}
                            {{-- @can('view rd committee') --}}
                            {{-- <li><a href="{{ route('divisions') }}">Division</a></li> --}}
                            {{-- <li><a href="{{ route('rd-committees') }}">RD Committees</a></li> --}}
                            {{-- @endcan --}}
                            {{-- @can('view municipal council') --}}
                            {{-- <li><a href="{{ route('municipal-council') }}">Municipal Council</a></li> --}}
                            {{-- @endcan --}}
                            {{-- <li><a href="{{ route('shehia-committees') }}">Shehia Committee</a></li> --}}
                        </ul>
                    </li>
                    {{-- @endcanany --}}
                    {{-- @endcanany --}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6 style="background: #334628;">Matayarisho (Preparation)</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('education') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                            </svg>
                            <span>Elimu na Mafunzo</span>
                        </a>
                    </li>
                   

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title " href="#">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-knowledgebase"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-knowledgebase"></use>
                            </svg>
                            <span class="">Manage Inventory</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('inventory-items') }}">Inventory items</a></li>
                            <li><a href="{{ route('inventory-transactions') }}">Inventory transaction</a></li>
                        </ul>
                    </li>

                    {{-- @canany(['long term', 'middle term', 'short term', 'international plan', 'regional plan']) --}}
                    <li class="sidebar-main-title">
                        <div>
                            <h6 style="background: #334628;"> Response </h6>
                        </div>
                    </li>
                    {{-- @canany(['long term', 'short term', 'middle term']) --}}
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('matukiolist') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                            </svg>
                            <span>Orodha ya Matukio</span>
                        </a>
                    </li>
                    {{-- @endcanany --}}
                    {{-- @can('regional plan') --}}
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('matukiolist') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                            </svg>
                            <span>Matukio Yangu</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('tukio-ndani') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                            </svg>
                            <span>Tuma Tukio</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                    {{-- @can('international plan') --}}

                    {{-- @endcan --}}
                    {{-- @can('international plan') --}}
                    {{-- <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                                    </svg>
                                    <span>Review and Reporting</span>
                                </a>
                            </li> --}}
                    {{-- @endcan --}}
                    {{-- @endcanany --}}

                    {{-- @canany(['view concept note', 'view concept note approval', 'view project proposal']) --}}

                    {{-- @canany(['view concept note', 'view concept note approval']) --}}
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="{{ route('forecast-list') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-to-do"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-to-do"></use>
                            </svg>
                            <span class="">Utabiri (Forecast)</span>
                        </a>

                    </li>
                    {{-- @endcanany --}}
                    {{-- @canany(['view project proposal']) --}}
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-to-do"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-to-do"></use>
                            </svg>
                            <span class="">Alert Reporting</span>
                        </a>

                    </li>
                    {{-- @endcanany --}}

                    {{-- @endcanany --}}

                    {{--                        @canany(['view region', 'view district', 'view shehia']) --}}
                    {{--                            <li class="sidebar-list"> --}}
                    {{--                                <i class="fa fa-thumb-tack"></i> --}}
                    {{--                                <a class="sidebar-link sidebar-title @if (request()->routeIs('regions')) active @endif" href="#"> --}}
                    {{--                                    <svg class="stroke-icon"> --}}
                    {{--                                        <use href="../assets/svg/icon-sprite.svg#stroke-maps"></use> --}}
                    {{--                                    </svg> --}}
                    {{--                                    <svg class="fill-icon"> --}}
                    {{--                                        <use href="../assets/svg/icon-sprite.svg#fill-maps"></use> --}}
                    {{--                                    </svg> --}}
                    {{--                                    <span >LGAs Project</span> --}}
                    {{--                                </a> --}}
                    {{--                                <ul class="sidebar-submenu"> --}}
                    {{--                                    @can('view region') --}}
                    {{--                                        <li><a href="{{ route('lga-challenges') }}" >Add Challenges</a></li> --}}
                    {{--                                    @endcan --}}
                    {{--                                    @can('view district') --}}
                    {{--                                        <li><a href="{{ route('lga-concept-note') }}">Concept Note</a></li> --}}
                    {{--                                    @endcan --}}
                    {{--                                    @can('view shehia') --}}
                    {{--                                        <li><a href="{{ route('lga-project-list') }}">Approval Project</a></li> --}}
                    {{--                                    @endcan --}}
                    {{--                                </ul> --}}
                    {{--                            </li> --}}
                    {{--                        @endcanany --}}

                    <li class="sidebar-main-title">
                        <div>
                            <h6 style="background: #334628;">Recovery </h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('matukiolist') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                            </svg>
                            <span>Damage Assessment</span>
                        </a>
                    </li>

                    {{-- @canany(['view project financial']) --}}
                        <li class="sidebar-main-title">
                            <div>
                                <h6 style="background: #334628;">Communication</h6>
                            </div>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-message"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-message"></use>
                                </svg>
                                <span class="">ZDMIS Bulk SMS</span>
                            </a>
                        </li>

                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-message"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-message"></use>
                                </svg>
                                <span class="">AI-Powered</span>
                            </a>

                        </li>
                        {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="{{ route('roles') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-widget"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-widget"></use>
                            </svg>
                            <span class="">Financing Listing</span>
                        </a>
                    </li> --}}
                    {{-- @endcanany --}}

                    {{-- @canany([
                        'view user authentication',
                        'view user ministry',
                        'view user institution',
                        'view user
                        department',
                        'view user municipal',
                        'view user rd committee',
                        'view role',
                        ]) --}}
                        <li class="sidebar-main-title">
                            <div>
                                <h6 style="background: #334628;">User Management</h6>
                            </div>
                        </li>
                        {{-- @can('view user authentication') --}}
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('user') }}">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-user"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-user"></use>
                                    </svg>
                                    <span class="">System Users</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('subscriber') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-user"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-user"></use>
                                </svg>
                                <span class="">Subscriber List</span>
                            </a>

                        </li>
                        {{-- @can('view role') --}}
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('majukumu') }}">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-others"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-others"></use>
                                    </svg>
                                    <span class="">Role and permission</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                    {{-- @endcanany --}}

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            // Function to normalize the path and remove query parameters or hashes
            function normalizePath(path) {
                var url = new URL(path, window.location.origin);
                return url.pathname; // Get only the pathname part of the URL
            }

            // Get the current path normalized
            var currentPath = normalizePath(window.location.href);
            console.log("Normalized Current Path:", currentPath);

            // Variables to keep track of the best matching link
            var bestMatch = null;
            var bestMatchLength = 0;

            // Iterate over each link in the sidebar
            $('.sidebar-wrapper a').each(function() {
                var linkPath = normalizePath($(this).attr('href'));
                console.log("Link Path:", linkPath); // Log each link path

                // Check if the link path is a part of the current path
                if (currentPath.startsWith(linkPath) && linkPath.length > bestMatchLength) {
                    bestMatch = this; // Store the best match
                    bestMatchLength = linkPath.length; // Update the length of the best match
                }
            });

            // If a best match is found, mark it as active and open the submenu
            if (bestMatch) {
                $(bestMatch).closest('a').addClass('active'); // Add active class to the closest li
                $(bestMatch).closest('span').addClass('text-light'); // Add active class to the closest li
                $(bestMatch).parents('.sidebar-submenu').slideDown('normal'); // Open all parent submenus
                $(bestMatch).parents('.sidebar-submenu').prev('.sidebar-title').addClass(
                    'active'); // Mark the parent titles as active
                // $(bestMatch).parents('.sidebar-list').addClass('bg-light'); // Mark the parent titles as active
            }
        });
    </script>
@endpush
