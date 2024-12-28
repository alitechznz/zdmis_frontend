<div>
    <div>
        <!-- Page Sidebar Ends-->
        <div>
          <div>
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6 ps-0">
                  <h3>Project Appraisal</h3>
                </div>
                <div class="col-sm-6 pe-0">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-xxl-3 col-xl-4 box-col-4e">
                <div class="md-sidebar"><a class="btn btn-primary email-aside-toggle md-sidebar-toggle">Job filter</a>
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
                                <div class="job-filter mb-2">
                                  <div class="faq-form">
                                    <input class="form-control" type="text" placeholder="Project Name" readonly>
                                  </div>
                                </div>
                                <div class="job-filter">
                                  <div class="faq-form">
                                    <input class="form-control" type="text" placeholder="Project Code" readonly>
                                  </div>
                                </div><br /><br />
                                <button class="btn btn-primary text-center" type="button">View Concept</button>
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
                <div class="card">
                  <div class="job-search">
                    <div class="card-body">
                      <div class="d-flex"><img class="img-40 img-fluid m-r-20" src="../assets/images/job-search/1.jpg" alt="">
                        <div class="flex-grow-1">
                          <h2 class="f-w-600"><a href="#">Project Appraisal Section</a><span class="badge badge-primary pull-right">New</span></h2>

                        </div>
                      </div>
                        <form style="margin-top: 40px;" wire:submit.prevent="SaveProjectDetails" method="post">
                            @csrf
                            @php $currentSection = null; @endphp

                                @foreach ($questions as $question)
                                    @if ($question->section != $currentSection)
                                        <h6 class="f-w-600">Section: {{ $question->section }}</h6>
                                        @php $currentSection = $question->section; @endphp
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">{{ $question->title }}</label>
                                        <div>
                                            <input type="radio" name="answers[{{ $question->id }}]" id="question{{ $question->id }}_yes" value="yes" required>
                                            <label for="question{{ $question->id }}_yes">Yes</label>
                                            <input type="radio" name="answers[{{ $question->id }}]" id="question{{ $question->id }}_no" value="no" required>
                                            <label for="question{{ $question->id }}_no">No</label>
                                        </div>
                                        <textarea class="form-control" name="comments[{{ $question->id }}]" id="comment{{ $question->id }}" placeholder="Enter comment" required></textarea>
                                    </div>
                                @endforeach

                            <button type="submit" class="btn btn-success">Submit Project Appraisal</button>
                        </form>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
  </div>

</div>
