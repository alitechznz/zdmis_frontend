@push('styles')
    <style>
        .bg-active {
            background-color: #56540B !important; /* This will change the text color to the specified greenish-yellow when active */
        }
    </style>
@endpush
<div class="sidebar-wrapper" data-layout="fill-svg">
    <div>
        <div class="logo-wrapper">
            <a href="#">
                <img class="img-fluid" src="{{ asset('logo/logo.png') }}" alt="">
            </a>
            <div class="toggle-sidebar">
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
                        <div><h6>Pinned</h6></div>
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
                            <span>Dashboard </span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('home') }}">National Project</a></li>
                            <li><a href="#">International Plan</a></li>
                            <li><a href="#">Regional Project</a></li>
                            <li><a href="#">LGA's Project</a></li>
                            <li><a href="#">PPP</a></li>
                        </ul>
                    </li>

                    @canany(['view region', 'view district', 'view shehia'])
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title @if(request()->routeIs('regions')) active @endif" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-maps"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-maps"></use>
                                </svg>
                                <span >Location</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('view region')
                                    <li><a href="{{ route('regions') }}" @if(request()->routeIs('regions')) class="active" @endif>Region</a></li>
                                @endcan
                                @can('view district')
                                    <li><a href="{{ route('districts') }}">District</a></li>
                                @endcan
                                @can('view shehia')
                                    <li><a href="{{ route('shehias') }}">Shehia</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany



                    {{-- @canany(['view ministry', 'view department', 'view institution', 'view rd committee', 'view municipal council','view screening question', 'view appraisal question', 'view source of finance', 'view zpc calendar', 'view budget form', 'view unit value', 'view financial particular', 'view sector']) --}}
                        <li class="sidebar-main-title">
                            <div><h6>Setup</h6></div>
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
                                    <span class="">Basic Setup</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    @can('view screening question')
                                        <li><a href="">Hazard Type</a></li>
                                    @endcan
                                    @can('view screening question')
                                        <li><a href="">Hazard Source</a></li>
                                    @endcan
                                    @can('view appraisal question')
                                        <li><a href="">Hazard Status</a></li>
                                    @endcan
                                    @can('view appraisal question')
                                        <li><a href="">Hazard Category</a></li>
                                    @endcan
                                    @can('view appraisal question')
                                        <li><a href="">Weather Source</a></li>
                                    @endcan
                                    @can('view appraisal question')
                                        <li><a href="">Measurement Unit</a></li>
                                    @endcan

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
                                @can('view ministry')
                                <li><a href="{{ route('ministry') }}">Ministries</a></li>
                                @endcan
                                @can('view institution')
                                <li><a href="{{ route('institutions') }}">Institutions</a></li>
                                @endcan
                                @can('view department')
                                <li><a href="{{ route('departments') }}">Departments</a></li>
                                @endcan
                                @can('view rd committee')
                                {{-- <li><a href="{{ route('divisions') }}">Division</a></li> --}}
                                <li><a href="{{ route('rd-committees') }}">RD Committees</a></li>
                                @endcan
                                @can('view municipal council')
                                <li><a href="{{ route('municipal-council') }}">Municipal Council</a></li>
                                @endcan
                                {{-- <li><a href="{{ route('shehia-committees') }}">Shehia Committee</a></li> --}}
                            </ul>
                        </li>
                        {{-- @endcanany --}}
                    {{-- @endcanany --}}

                    {{-- @canany(["long term","middle term","short term", 'international plan', 'regional plan']) --}}
                        <li class="sidebar-main-title">
                            <div><h6>Incident Reporting</h6></div>
                        </li>
                        {{-- @canany(['long term', 'short term', 'middle term']) --}}
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                                    </svg>
                                    <span>Incident Logging</span>
                                </a>
                            </li>
                        {{-- @endcanany --}}
                        {{-- @can('regional plan') --}}
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                                    </svg>
                                    <span>Automated Notifications</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                        {{-- @can('international plan') --}}
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                                    </svg>
                                    <span>Incident Status Tracking</span>
                                </a>
                            </li>
                        {{-- @endcan --}}
                        {{-- @can('international plan') --}}
                            <li class="sidebar-list">
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
                            </li>
                        {{-- @endcan --}}
                    {{-- @endcanany --}}

                    {{-- @canany(["view concept note", "view concept note approval", "view project proposal"]) --}}
                        <li class="sidebar-main-title">
                            <div><h6>Weather Data </h6></div>
                        </li>
                        {{-- @canany(["view concept note", "view concept note approval"]) --}}
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title" href="#">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-to-do"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-to-do"></use>
                                    </svg>
                                    <span class="">Forecast</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    {{-- @can('view concept note') --}}
                                    <li><a href="{{ route('forecast-list') }}">Forecast Monitoring</a></li>
                                    {{-- @endcan --}}
                                    {{-- @can('view concept note approval') --}}
                                    <li><a href="">Forecast Evaluation</a></li>
                                    {{-- @endcan --}}
                                    {{-- <li><a href="{{ route('concept-note-screening-list') }}">Screening List</a></li> --}}
                                    {{-- <li><a href="{{ route('concept-note-decision') }}">Concept Note Decision</a></li> --}}
                                </ul>
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
                                <ul class="sidebar-submenu">
                                    @can('view project proposal')
                                        <li><a href="">Reporting</a></li>
                                    @endcan
                                    @can('view project proposal appraisal')
                                        <li><a href="">Review and Analysis</a></li>
                                    @endcan
                                    <li><a href="">Visualize</a></li>

                                </ul>
                            </li>
                        {{-- @endcanany --}}

                    {{-- @endcanany --}}

{{--                        @canany(['view region', 'view district', 'view shehia'])--}}
{{--                            <li class="sidebar-list">--}}
{{--                                <i class="fa fa-thumb-tack"></i>--}}
{{--                                <a class="sidebar-link sidebar-title @if(request()->routeIs('regions')) active @endif" href="#">--}}
{{--                                    <svg class="stroke-icon">--}}
{{--                                        <use href="../assets/svg/icon-sprite.svg#stroke-maps"></use>--}}
{{--                                    </svg>--}}
{{--                                    <svg class="fill-icon">--}}
{{--                                        <use href="../assets/svg/icon-sprite.svg#fill-maps"></use>--}}
{{--                                    </svg>--}}
{{--                                    <span >LGAs Project</span>--}}
{{--                                </a>--}}
{{--                                <ul class="sidebar-submenu">--}}
{{--                                    @can('view region')--}}
{{--                                        <li><a href="{{ route('lga-challenges') }}" >Add Challenges</a></li>--}}
{{--                                    @endcan--}}
{{--                                    @can('view district')--}}
{{--                                        <li><a href="{{ route('lga-concept-note') }}">Concept Note</a></li>--}}
{{--                                    @endcan--}}
{{--                                    @can('view shehia')--}}
{{--                                        <li><a href="{{ route('lga-project-list') }}">Approval Project</a></li>--}}
{{--                                    @endcan--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        @endcanany--}}


                    @canany(['view project financial'])
                    <li class="sidebar-main-title">
                        <div><h6>Communication</h6></div>
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
                        <a class="sidebar-link sidebar-title link-nav" href="">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-message"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-message"></use>
                            </svg>
                            <span class="">ZDMIS Chart</span>
                        </a>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-message"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-message"></use>
                            </svg>
                            <span class="">ZDMIS Toll-Free</span>
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
                        <ul class="sidebar-submenu">
                                <li><a href="">Request Disbursing</a></li>
                                <li><a href="">Domestic Financing</a></li>
                                <li><a href="">External Financing</a></li>
                        </ul>
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
                    @endcanany

                    @canany(['view user authentication', 'view user ministry', 'view user institution', 'view user department', 'view user municipal', 'view user rd committee', 'view role'])
                        <li class="sidebar-main-title">
                            <div><h6>User Management</h6></div>
                        </li>
                        @can('view user authentication')
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('users') }}">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-user"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-user"></use>
                                    </svg>
                                    <span class="">System Users</span>
                                </a>
                            </li>
                        @endcan
                        <li class="sidebar-list"    ><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-user"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-user"></use>
                                </svg>
                                <span class="">M<small>DA</small> / L<small>GA</small>'s Users</span>
                            </a>
                            <ul class="sidebar-submenu">
                                @can('view user ministry')
                                <li><a href="{{ route('ministry.users') }}">Ministry User</a></li>
                                @endcan
                                @can('view user institution')
                                <li><a href="{{ route('institution.users') }}">Institution User</a></li>
                                @endcan
                                @can('view user department')
                                <li><a href="{{ route('department.users') }}">Department User</a></li>
                                @endcan
                                @can('view user municipal')
                                {{-- <li><a href="{{ route('division.users') }}">Division User</a></li> --}}
                                <li><a href="{{ route('municipal.users') }}">Municipal User</a></li>
                                @endcan
                                @can('view user rd committee')
                                <li><a href="">RD Committee User</a></li>
                                @endcan
                            </ul>
                        </li>
                        @can('view role')
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('roles') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-others"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-others"></use>
                                </svg>
                                <span class="">Role and permission</span>
                            </a>
                        </li>
                        @endcan
                    @endcanany

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
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
            $('.sidebar-wrapper a').each(function () {
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
                $(bestMatch).parents('.sidebar-submenu').prev('.sidebar-title').addClass('active'); // Mark the parent titles as active
                // $(bestMatch).parents('.sidebar-list').addClass('bg-light'); // Mark the parent titles as active
            }
        });
    </script>
@endpush
