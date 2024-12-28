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



                    @canany(['view ministry', 'view department', 'view institution', 'view rd committee', 'view municipal council','view screening question', 'view appraisal question', 'view source of finance', 'view zpc calendar', 'view budget form', 'view unit value', 'view financial particular', 'view sector'])
                        <li class="sidebar-main-title">
                            <div><h6>Setup</h6></div>
                        </li>
                        @canany(['view screening question', 'view appraisal question', 'view source of finance', 'view zpc calendar', 'view budget form', 'view unit value', 'view financial particular', 'view sector'])
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
                                        <li><a href="{{ route('project-questions') }}">Screening Questions</a></li>
                                    @endcan
                                    @can('view appraisal question')
                                        <li><a href="{{ route('appraisal-questions') }}">Appraisal Questions</a></li>
                                    @endcan
                                    @can('view source of finance')
                                        <li><a href="{{ route('source-financings') }}">Source of Finance</a></li>
                                    @endcan
                                    @can('view zpc calendar')
                                        <li><a href="{{ route('project-calendars') }}">ZPC Calendar</a></li>
                                    @endcan
                                    @can('view budget form')
                                        <li><a href="{{ route('budget-terms') }}">Budget Terms</a></li>
                                    @endcan
                                    @can('view unit value')
                                        <li><a href="{{ route('unit-values') }}">Unit Values</a></li>
                                    @endcan
                                    @can('view financial particular')
                                        <li><a href="{{ route('finance-particulars') }}">Financial Particulars</a></li>
                                    @endcan
                                    @can('view sector')
                                        <li><a href="{{ route('sectors') }}">Sectors</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        @canany(['view ministry', 'view institution', 'view department', 'view rd committee', 'view municipal council'])
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
                        @endcanany
                    @endcanany

                    @canany(["long term","middle term","short term", 'international plan', 'regional plan'])
                        <li class="sidebar-main-title">
                            <div><h6>Plan</h6></div>
                        </li>
                        @canany(['long term', 'short term', 'middle term'])
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('national-plan') }}">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                                    </svg>
                                    <span>National Plan</span>
                                </a>
                            </li>
                        @endcanany
                        @can('regional plan')
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('regional-plan') }}">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                                    </svg>
                                    <span>Regional Plan</span>
                                </a>
                            </li>
                        @endcan
                        @can('international plan')
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('internation-plan') }}">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-task"></use>
                                    </svg>
                                    <span>Internation Plan</span>
                                </a>
                            </li>
                        @endcan
                    @endcanany

                    @canany(["view concept note", "view concept note approval", "view project proposal"])
                        <li class="sidebar-main-title">
                            <div><h6>Project Management</h6></div>
                        </li>
                        @canany(["view concept note", "view concept note approval"])
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title" href="#">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-to-do"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-to-do"></use>
                                    </svg>
                                    <span class="">Concept Notes</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    @can('view concept note')
                                    <li><a href="{{ route('concept-note-list') }}">Concept Note List</a></li>
                                    @endcan
                                    @can('view concept note approval')
                                    <li><a href="{{ route('concept-note-approved')}}">Concept Note Approved</a></li>
                                    @endcan
                                    {{-- <li><a href="{{ route('concept-note-screening-list') }}">Screening List</a></li> --}}
                                    {{-- <li><a href="{{ route('concept-note-decision') }}">Concept Note Decision</a></li> --}}
                                </ul>
                            </li>
                        @endcanany
                        @canany(['view project proposal'])
                            <li class="sidebar-list">
                                <i class="fa fa-thumb-tack"></i>
                                <a class="sidebar-link sidebar-title" href="#">
                                    <svg class="stroke-icon">
                                        <use href="../assets/svg/icon-sprite.svg#stroke-to-do"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="../assets/svg/icon-sprite.svg#fill-to-do"></use>
                                    </svg>
                                    <span class="">Project Proposal</span>
                                </a>
                                <ul class="sidebar-submenu">
                                    @can('view project proposal')
                                        <li><a href="{{ route('proposal-list')}}">Project Proposal List</a></li>
                                    @endcan
                                    @can('view project proposal appraisal')
                                        <li><a href="{{ route('proposal-appraisal') }}">Project Proposal Appraisal</a></li>
                                    @endcan
                                    <li><a href="{{ route('proposal-appraisal-list') }}">Appraisal List</a></li>
                                    @can('view proposal decision')
                                        <li><a href="{{ route('proposal-decision')}}">Project Proposal Decision</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endcanany
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-task"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-layout"></use>
                                </svg>
                                <span class="">Projects</span>
                            </a>
                            <ul class="sidebar-submenu">
                                <li><a href="#">National Project</a></li>
                                <li><a href="#">LGA's Project</a></li>
                                <li><a href="{{ route('lga-challeges') }}">LGA's Challenge</a></li>
                                <li><a href="{{ route('lga-project-concept-note') }}">LGA's Concept Note</a></li>
                                <li><a href="{{ route('lga-approve-list') }}">Approve List</a></li>
                                <li><a href="#">PPP Project</a></li>
                                <li><a href="#">Investment Project</a></li>
                                <li><a href="#">Wabunge & Wawakilishi Project</a></li>
                                <li><a href="#">OFF Budget</a></li>
                            </ul>
                        </li>

                        @can('request implementation')
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-to-do"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-to-do"></use>
                                </svg>
                                <span class="">Implementation</span></a>
                            <ul class="sidebar-submenu">
                                @can('view implementation request')
                                    <li><a href="{{ route('view-request-implementations') }}">Request Implementation</a></li>
                                @endcan
                                <li><a href="{{ route('request-extension') }}">Request Extension</a></li>
                                <li><a href="{{ route('manage-extension') }}">Manage Extension</a></li>
                            </ul>
                        </li>
                        @endcan
                    @endcanany

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
                        <div><h6>Project Financing</h6></div>
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
                            <span class="">Project Budget</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('sponsors') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-message"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-message"></use>
                            </svg>
                            <span class="">Development Partner</span>
                        </a>
                    </li>
                    <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="{{ route('financing-agreements') }}">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-message"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="../assets/svg/icon-sprite.svg#fill-message"></use>
                            </svg>
                            <span class="">Financing Agreement</span>
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
                            <span class="">Disbursing Amount</span>
                        </a>
                        <ul class="sidebar-submenu">
                                <li><a href="{{ route('view-request-disbursings') }}">Request Disbursing</a></li>
                                <li><a href="{{ route('domestic-financings') }}">Domestic Financing</a></li>
                                <li><a href="{{ route('shehias') }}">External Financing</a></li>
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

                    @can('view project monitoring')
                        <li class="sidebar-main-title">
                            <div><h6>Project Monitoring</h6></div>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('m-e-plans') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-animation"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-animation"></use>
                                </svg>
                                <span class="">M&E Plan</span>
                            </a>
                        </li>
                        {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('resource-lists') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-widget"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-widget"></use>
                                </svg>
                                <span class="">Resource Tracking</span>
                            </a>
                        </li> --}}
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            @can('add monitoring')
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('monitoring-form') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-animation"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-animation"></use>
                                </svg>
                                <span class="">Monitoring Form</span>
                            </a>
                            @endcan

                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title link-nav" href="{{ route('resource-lists') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-animation"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-animation"></use>
                                </svg>
                                <span class="">Implementation Rep..</span>
                            </a>
                        </li>
                    @endcan

                    @can('view project evaluation')
                        <li class="sidebar-main-title">
                            <div><h6>Project Evaluation</h6></div>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-builders"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-builders"></use>
                                </svg>
                                <span class="">Project Evaluation</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-builders"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-builders"></use>
                                </svg>
                                <span class="">Plan Evaluation</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('users') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-builders"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-builders"></use>
                                </svg>
                                <span class="">Org Evaluation</span>
                            </a>
                        </li>
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('roles') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-builders"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-builders"></use>
                                </svg>
                                <span class="">Risks & Challenges</span>
                            </a>
                        </li>
                    @endcan

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
                                <li><a href="{{ route('rd-committee.users') }}">RD Committee User</a></li>
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

                    @canany(['view program/project report', 'view stakeholder report', 'view monitoring report', 'view financing report', "view LGA's report"])
                        <li class="sidebar-main-title">
                            <div><h6>Reports</h6></div>
                        </li>
                        @can('view program/project report')
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-file"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                                </svg>
                                <span class="">Program/Project</span>
                            </a>
                        </li>
                        @endcan
                        @can('view stakeholder report')
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-file"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                                </svg>
                                <span class="">Stakeholders</span>
                            </a>
                        </li>
                        @endcan
                        @can('view stakeholder')
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('users') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-file"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                                </svg>
                                <span class="">Monitoring</span>
                            </a>
                        </li>
                        @endcan
                        @can('view monitoring report')
                        <li class="sidebar-list"><i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('roles') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-file"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                                </svg>
                                <span class="">Financing</span>
                            </a>

                        </li>
                        @endcan
                        @can('view financing report')
                        <li class="sidebar-list">
                            <i class="fa fa-thumb-tack"></i>
                            <a class="sidebar-link sidebar-title" href="{{ route('roles') }}">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-file"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="../assets/svg/icon-sprite.svg#fill-file"></use>
                                </svg>
                                <span class="">LGAs</span>
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
