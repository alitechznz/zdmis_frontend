<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>International Plan</h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Plan</li>
                    </ol>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="container-fluid default-dashboard">
        <div class="card">
            <div class="card-body">
                <!-- Main Tab Content -->
                <div class="tab-content" id="planTabContent">
                    <div class="tab-pane fade show active" id="long-term" role="tabpanel" aria-labelledby="long-term-tab">
                        <ul class="nav nav-tabs mb-3" id="nestedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="plans-tab" data-bs-toggle="tab" data-bs-target="#plans" type="button" role="tab" aria-controls="plans" aria-selected="true">Plan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pillars-tab" data-bs-toggle="tab" data-bs-target="#pillars" type="button" role="tab" aria-controls="pillars" aria-selected="true">Goal</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="target-tab" data-bs-toggle="tab" data-bs-target="#target" type="button" role="tab" aria-controls="target" aria-selected="false">Target</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="indicator-tab" data-bs-toggle="tab" data-bs-target="#indicator" type="button" role="tab" aria-controls="indicator" aria-selected="false">Indicator</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="nestedTabContent">
                            <!-- Plan tab -->
                            <div class="tab-pane fade show active" id="plans" role="tabpanel" aria-labelledby="plans-tab">
                                @livewire('plan-component', ['International'])
                            </div>
                            <!-- Pillar tab -->
                            <div class="tab-pane fade show" id="pillars" role="tabpanel" aria-labelledby="pillars-tab">
                                @livewire('goal-component', ['International'])
                            </div>
                            <!-- Target  tab -->
                            <div class="tab-pane fade" id="target" role="tabpanel" aria-labelledby="target-tab">
                                @livewire('target-component', ['International', null])
                            </div>
                            <!-- Indicator tab -->
                            <div class="tab-pane fade" id="indicator" role="tabpanel" aria-labelledby="indicator-tab">
                                @livewire('kpi-component', ['International', null])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
