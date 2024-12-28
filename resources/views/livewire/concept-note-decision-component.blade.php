<div>
      <!-- Page Sidebar Ends-->
      <div>
        <div>
          <div class="page-title">
            <div class="row">
              <div class="col-sm-6 ps-0">
                <h3>Concept Note Feedback</h3>
              </div>
              <div class="col-sm-6 pe-0">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">
                      <svg class="stroke-icon">
                        <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                      </svg></a></li>
                  {{-- <li class="breadcrumb-item">Job Search</li>
                  <li class="breadcrumb-item active"> List View</li> --}}
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
          <div class="row">
            <div class="col-xxl-3 col-xl-4 box-col-4e">
              <div class="md-sidebar"><a class="btn btn-primary email-aside-toggle md-sidebar-toggle"></a>
                <div class="md-sidebar-aside job-sidebar">
                  <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc">
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="card">
                          <div class="card-header">
                            <h5 class="mb-0">
                              <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapseicon">Project Details</button>
                            </h5>
                          </div>
                          <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-bs-parent="#accordion">
                            <div class="card-body filter-cards-view animate-chk">
                              @if($conceptnote)
                                <div class="job-filter mb-2">
                                  <div class="faq-form">
                                    <input class="form-control" type="text" value="{{ $conceptnote->projectname}}" placeholder="project name" readonly>
                                  </div>
                                </div>
                                <div class="job-filter">
                                  <div class="faq-form">
                                    <input class="form-control" type="text" value="{{ $conceptnote->project_code}}" placeholder="project_code" readonly>
                                  </div>
                                </div>
                              @else
                                <p>loading........</p>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                     
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-9 col-xl-8 box-col-8">
                @forelse($feedback as $decisionFlow)
                    <div class="card ribbon-vertical-left-wrapper">
                        @if($decisionFlow->action =='accept')
                            <div class="ribbon ribbon-bookmark ribbon-vertical-left ribbon-success"><i class="icofont icofont-love"></i></div>
                        @elseif ($decisionFlow->status =='Initiated')
                            <div class="ribbon ribbon-bookmark ribbon-vertical-left ribbon-success"><i class="icofont icofont-love"></i></div>
                        @else
                            <div class="ribbon ribbon-bookmark ribbon-vertical-left ribbon-danger"><i class="icofont icofont-love"></i></div>
                        @endif
                        
                        <div class="job-search">
                        <div class="card-body">
                            <div class="d-flex"><i class="fa fa-user fa-3x"></i>
                            <div class="flex-grow-1">
                                <h6 class="f-w-600"><a href="#">{{$decisionFlow->status}}</a><span class="pull-right">{{ $decisionFlow->created_at->diffForHumans() }}</span></h6>
                                <p>{{$decisionFlow->created_at->format('d-m-Y H:i:s')}}</p>
                            </div>
                            </div>
                            @if($decisionFlow->action =='accept')
                                <span class="badge badge-success">{{ucfirst($decisionFlow->action)}}</span>
                            @elseif ($decisionFlow->status =='Initiated')
                                <span class="badge badge-success">{{ucfirst($decisionFlow->action)}}</span>
                            @else
                                <span class="badge badge-danger">{{ucfirst($decisionFlow->action)}}</span>
                            @endif
                            
                            <p>{{$decisionFlow->comment}}</p>
                        </div>
                        </div>
                    </div>
                @empty
                    <p>Loading.................</p>
                @endforelse
              
            </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>
</div>
