<div>
    <div class="container-fluid">
        <div class="page-title">
          <div class="row">
            <div class="col-sm-6 p-0">
              <h3>Default Dashboard </h3>
            </div>
            <div class="col-sm-6 p-0">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">
                    <svg class="stroke-icon">
                      <use href="#"></use>
                    </svg></a></li>
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Default      </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- Container-fluid starts-->
          <!-- Container-fluid starts-->
          <div class="container-fluid default-dashboard">
            <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-7 box-col-4">
                <div class="card welcome-card">
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="flex-grow-1">
                        <h1>Hello, {{ auth()->user()->name }}.</h1>
                        <p>Welcome to the Admin clan! We appreciate your interest in our ZiPS dashboard.</p>
                      </div>
                      <div class="flex-shrink-0"> <img src="../assets/images/dashboard/welcome.png" alt=""></div>
                      <div>
                        <div class="clockbox">
                          <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                            <g id="face">
                              <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                              <path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6"></path>
                              <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                            </g>
                            <g id="hour">
                              <path class="hour-hand" d="M300.5 298V142"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="minute">
                              <path class="minute-hand" d="M300.5 298V67">   </path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="second">
                              <path class="second-hand" d="M300.5 350V55"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9">   </circle>
                            </g>
                          </svg>
                          <div class="badge f-10 p-0" id="txt"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-8 col-lg-8 col-md-8 box-col-8">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                      <div class="card total-sales">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-xl-8 xl-12 col-md-8 col-sm-12 col box-col-12">
                              <div class="d-flex">

                                <div class="flex-shrink-0">
                                  <h4>10</h4>
                                  <h6>Matukio </h6>
                                  <div class="arrow-chart">
                                    <div style="display: flex; justify-content: center;">
                                        <i class="fa fa-sticky-note fa-3x" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="font-danger">Active</h5>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                      <div class="card total-sales">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-xl-4 xl-8 col-md-4 col-sm-8 col box-col-8">
                              <div class="d-flex up-sales">
                                <div class="flex-shrink-0">
                                  <h4>7</h4>
                                  <h6>Tukio yaliyoshughulikiwa</h6>
                                  <div class="arrow-chart">
                                    <div style="display: flex; justify-content: center;">
                                        <i class="fa fa-file fa-3x" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="font-success">70%</h5>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                      <div class="card total-sales">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-xl-8 xl-12 col-md-8 col-sm-12 col box-col-12">
                              <div class="d-flex total-customer">
                                <div class="flex-shrink-0">
                                  <h4>3</h4>
                                  <h6>Tukio Yana shughulikiwa</h6>
                                  <div class="arrow-chart">
                                    <div style="display: flex; justify-content: center;">
                                        <i class="fa fa-tasks fa-3x" aria-hidden="true"></i>
                                    </div>
                                    <h5 class="font-success">30%</h5>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="card total-sales">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-xl-8 xl-12 col-md-8 col-sm-12 col box-col-12">
                                <div class="d-flex">

                                  <div class="flex-shrink-0">
                                    <h4>20</h4>
                                    <h6>Simu (Waliojiunga) </h6>
                                    <div class="arrow-chart">
                                        <div style="display: flex; justify-content: center;">
                                            <i class="fa fa-tasks fa-3x" aria-hidden="true"></i>
                                        </div>
                                      <h5 class="font-success">active</h5>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="card total-sales">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-xl-4 xl-8 col-md-4 col-sm-8 col box-col-8">
                                <div class="d-flex up-sales">
                                  <div class="flex-shrink-0">
                                    <h4>30</h4>
                                    <h6>Barua Pepe (Waliojiunga) </h6>
                                    <div class="arrow-chart">
                                        <div style="display: flex; justify-content: center;">
                                            <i class="fa fa-tasks fa-3x" aria-hidden="true"></i>
                                        </div>
                                      <h5 class="font-success">Active </h5>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="card total-sales" >
                          <div class="card-body">
                            <div class="row" >
                              <div class="col-xl-8 xl-12 col-md-8 col-sm-12 col box-col-12">
                                <div class="d-flex total-customer">
                                  <div class="flex-shrink-0" >
                                    <h4></h4>
                                    <h6>Total Investment Projects</h6>
                                    <div class="arrow-chart">
                                      <div style="display: flex; justify-content: center;">
                                          <i class="fa fa-tasks fa-3x" aria-hidden="true"></i>
                                      </div>
                                      <h5 class="font-success"> </h5>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-8 box-col-8">
                        <div class="card o-hidden">
                          <div class="card-header">
                            <h4>Monthly Financing History</h4>
                            <div class="card-header-center-icon" style="margin-left:0%;">
                                <div class="dropdown">
                                  <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown">Budget Year</button>
                                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#">2024/25</a><a class="dropdown-item" href="#">2023/24</a><a class="dropdown-item" href="#">2022/23</a></div>
                                </div>
                            </div>
                          </div>
                          <div class="bar-chart-widget">
                            <div class="bottom-content card-body">
                              <div class="row">
                                <div class="col-12">
                                  <div id="chart-widget4"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 proorder-xl-1">
                        <div class="card">
                          <div class="card-header pb-0">
                            <div class="header-top">
                              <h5>Upcoming Deadlines</h5>
                              <div class="dropdown icon-dropdown">
                                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item" href="#">Monthly</a><a class="dropdown-item" href="#">Yearly</a></div>
                              </div>
                            </div>
                          </div>
                          <div class="card-body pt-0 upcoming">
                            <div class="table-responsive custom-scrollbar">
                              <table class="table display" id="upcoming-deadlines" style="width:100%">
                                <thead>
                                  <tr>
                                    <th>SN</th>
                                    <th>Task</th>
                                    <th>Deadline</th>
                                    <th>Progress</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @php $sn =1; @endphp
                                 
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
