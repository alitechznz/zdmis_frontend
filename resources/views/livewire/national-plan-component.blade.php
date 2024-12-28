<div x-data="data()" class="m-2">
    {{-- <style>
        .compact .btn {
            padding-bottom: 1.3pt;
            padding-top: 1.3pt;
        }

        /* Custom Styles */
        .nav-tabs .nav-link.active {
            background-color: #28a745; /* Bootstrap green color */
            color: white;
        }

        .nav-tabs .nav-link {
            border-color: #28a745;
        }

        .tab-content {
            background-color: #f4f4f4;
            padding: 20px;
            border: 1px solid #28a745;
            border-top: none;
        }

        .table-custom {
            background-color: white;
            border-collapse: collapse;
        }

        .table-custom th, .table-custom td {
            border: 1px solid #dee2e6;
            padding: 8px 16px;
        }

        .table-custom th {
            background-color: #e9ecef;
        }

        .form-select {
            width: auto; /* Adjust width as needed */
            display: inline-block;
        }
        .btn-success {
            margin-top: 1rem;
        }
        .form-label {
            margin-right: 10px;
        }
    </style>--}}
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>National Plan</h3>
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
                <!-- Main Tab Navigation -->
                <ul class="nav nav-tabs" id="planTab" role="tablist">
                    <li class="nav-item">
                        <button wire:click.prevent="switchTab('long_term')" class="nav-link {{ $activeTab == 'long_term' ? 'active' : '' }}" type="button">Long Term Plan</button>
                    </li>
                    <li class="nav-item">
                        <button wire:click.prevent="switchTab('middle_term')" class="nav-link {{ $activeTab == 'middle_term' ? 'active' : '' }}" type="button">Mid Term Plan</button>
                    </li>
                    <li class="nav-item">
                        <button wire:click.prevent="switchTab('short_term')" class="nav-link {{ $activeTab == 'short_term' ? 'active' : '' }}" type="button">Short Term Plan</button>
                    </li>
                </ul>

                <!-- Main Tab Content -->
                <div class="tab-content" id="planTabContent">
                    <!-- Long Term Plan Nested Tabs -->
                    @if($activeTab == "long_term")
                    <div class="tab-pane fade show active" id="long-term" role="tabpanel" aria-labelledby="long-term-tab">
                        <ul class="nav nav-tabs mt-3" id="nestedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="plans-tab" data-bs-toggle="tab" data-bs-target="#plans" type="button" role="tab" aria-controls="plans" aria-selected="true">Plan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pillars-tab" data-bs-toggle="tab" data-bs-target="#pillars" type="button" role="tab" aria-controls="pillars" aria-selected="true">Pillar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="priorityarea-tab" data-bs-toggle="tab" data-bs-target="#priorityarea" type="button" role="tab" aria-controls="priorityarea" aria-selected="false">Priority Area</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="aspiration-tab" data-bs-toggle="tab" data-bs-target="#aspiration" type="button" role="tab" aria-controls="aspiration" aria-selected="false">Aspiration</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="indicator-tab" data-bs-toggle="tab" data-bs-target="#indicator" type="button" role="tab" aria-controls="indicator" aria-selected="false">Indicator</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="baseline-tab" data-bs-toggle="tab" data-bs-target="#baseline" type="button" role="tab" aria-controls="baseline" aria-selected="false">Baseline</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="target-tab" data-bs-toggle="tab" data-bs-target="#target" type="button" role="tab" aria-controls="target" aria-selected="false">Target</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="nestedTabContent">
                            <!-- Plan tab -->
                            <div class="tab-pane fade show active" id="plans" role="tabpanel" aria-labelledby="plans-tab">
                                @livewire('plan-component', ['National', 'long term'])
                            </div>
                            <!-- Pillar tab -->
                            <div class="tab-pane fade show" id="pillars" role="tabpanel" aria-labelledby="pillars-tab">
                                @livewire('pillar-component', ['National','long term'])
                            </div>
                            <!-- Priority tab -->
                            <div class="tab-pane fade" id="priorityarea" role="tabpanel" aria-labelledby="priorityarea-tab">
                                @livewire('priority-area-component', ['National','long term'])
                            </div>
                            <!-- Aspiration tab -->
                            <div class="tab-pane fade" id="aspiration" role="tabpanel" aria-labelledby="aspiration-tab">
                                @livewire('aspiration-component', ['National','long term'])
                            </div>
                            <!-- Indicator tab -->
                            <div class="tab-pane fade" id="indicator" role="tabpanel" aria-labelledby="indicator-tab">
                                @livewire('kpi-component', ['National','long term'])
                            </div>
                            <!-- Baseline tab -->
                            <div class="tab-pane fade" id="baseline" role="tabpanel" aria-labelledby="baseline-tab">
                                @livewire('baseline-component', ['National','long term'])
                            </div>
                            <!-- Target  tab -->
                            <div class="tab-pane fade" id="target" role="tabpanel" aria-labelledby="target-tab">
                                @livewire('target-component', ['National','long term'])
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($activeTab == "middle_term")
                    <div class="tab-pane fade show active" id="middle-term" role="tabpanel-mid" aria-labelledby="middle-term-tab">
                        <div class="tab-pane fade show active" id="long-term" role="tabpanel" aria-labelledby="long-term-tab">
                            <ul class="nav nav-tabs mt-3" id="nestedTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pla-tab" data-bs-toggle="tab" data-bs-target="#pla" type="button" role="tab" aria-controls="pla" aria-selected="true">Plan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="s-area-tab" data-bs-toggle="tab" data-bs-target="#s-area" type="button" role="tab" aria-controls="s-area" aria-selected="true">Strategic Area</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="p-area-tab" data-bs-toggle="tab" data-bs-target="#p-area" type="button" role="tab" aria-controls="p-area" aria-selected="false">Priority Area</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="s-inter-tab" data-bs-toggle="tab" data-bs-target="#s-inter" type="button" role="tab" aria-controls="s-inter" aria-selected="false">Strategic Intervention</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="indic-tab" data-bs-toggle="tab" data-bs-target="#indic" type="button" role="tab" aria-controls="indic" aria-selected="false">Indicator</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="base-tab" data-bs-toggle="tab" data-bs-target="#base" type="button" role="tab" aria-controls="base" aria-selected="false">Baseline</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tar-tab" data-bs-toggle="tab" data-bs-target="#tar" type="button" role="tab" aria-controls="tar" aria-selected="false">Target</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="nestedTabContent">
                                <!-- Plan tab -->
                                <div class="tab-pane fade show active" id="pla" role="tabpanel" aria-labelledby="pla-tab">
                                    @livewire('plan-component', ['National', 'middle term'])
                                </div>
                                <!-- strategic area tab -->
                                <div class="tab-pane fade" id="s-area" role="tabpanel" aria-labelledby="s-area-tab">
                                    @livewire('pillar-component', ['National','middle term'])
                                </div>
                                <!-- priority area tab -->
                                <div class="tab-pane fade" id="p-area" role="tabpanel" aria-labelledby="p-area-tab">
                                    @livewire('priority-area-component', ['National','middle term'])
                                </div>
                                <!-- strategic area tab -->
                                <div class="tab-pane fade" id="s-inter" role="tabpanel" aria-labelledby="s-inter-tab">
                                    @livewire('aspiration-component', ['National','middle term'])
                                </div>
                                <!-- indicator tab -->
                                <div class="tab-pane fade" id="indic" role="tabpanel" aria-labelledby="indic-tab">
                                    @livewire('kpi-component', ['National','middle term'])
                                </div>
                                <!-- baseline tab -->
                                <div class="tab-pane fade" id="base" role="tabpanel" aria-labelledby="base-tab">
                                    @livewire('baseline-component', ['National', 'middle term'])
                                </div>
                                <!-- target tab -->
                                <div class="tab-pane fade" id="tar" role="tabpanel" aria-labelledby="tar-tab">
                                    @livewire('target-component', ['National','middle term'])
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($activeTab == "short_term")
                    <div class="tab-pane fade show active" id="short-term" role="tabpanel" aria-labelledby="short-term-tab">
                        <div class="tab-pane fade show active" id="long-term" role="tabpanel" aria-labelledby="long-term-tab">
                            <ul class="nav nav-tabs mt-3" id="nestedTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pla-s-tab" data-bs-toggle="tab" data-bs-target="#pla-s" type="button" role="tab" aria-controls="pla-s" aria-selected="true">Plan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="s-area-tab" data-bs-toggle="tab" data-bs-target="#s-area-s" type="button" role="tab" aria-controls="s-area-s" aria-selected="true">Strategic Area</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="p-area-s-tab" data-bs-toggle="tab" data-bs-target="#p-area-s" type="button" role="tab" aria-controls="p-area-s" aria-selected="false">Priority Area</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="s-inter-s-tab" data-bs-toggle="tab" data-bs-target="#s-inter-s" type="button" role="tab" aria-controls="s-inter-s" aria-selected="false">Activities</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="indic-s-tab" data-bs-toggle="tab" data-bs-target="#indic-s" type="button" role="tab" aria-controls="indic-s" aria-selected="false">Indicator</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="base-s-tab" data-bs-toggle="tab" data-bs-target="#base-s" type="button" role="tab" aria-controls="base-s" aria-selected="false">Baseline</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tar-s-tab" data-bs-toggle="tab" data-bs-target="#tar-s" type="button" role="tab" aria-controls="tar-s" aria-selected="false">Target</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="nestedTabContent">
                                <!-- Plan tab -->
                                <div class="tab-pane fade show active" id="pla-s" role="tabpanel" aria-labelledby="pla-s-tab">
                                    @livewire('plan-component', ['National', 'short term'])
                                </div>
                                <!-- strategic area tab -->
                                <div class="tab-pane fade" id="s-area-s" role="tabpanel" aria-labelledby="s-area-s-tab">
                                    @livewire('pillar-component', ['National', 'short term'])
                                </div>
                                <!-- priority area tab -->
                                <div class="tab-pane fade" id="p-area-s" role="tabpanel" aria-labelledby="p-area-s-tab">
                                    @livewire('priority-area-component', ['National', 'short term'])
                                </div>
                                <!-- strategic area tab -->
                                <div class="tab-pane fade" id="s-inter-s" role="tabpanel" aria-labelledby="s-inter-s-tab">
                                    @livewire('aspiration-component', ['National', 'short term'])
                                </div>
                                <!-- indicator tab -->
                                <div class="tab-pane fade" id="indic-s" role="tabpanel" aria-labelledby="indic-tab">
                                    @livewire('kpi-component', ['National', 'short term'])
                                </div>
                                <!-- baseline tab -->
                                <div class="tab-pane fade" id="base-s" role="tabpanel" aria-labelledby="base-s-tab">
                                    @livewire('baseline-component', ['National', 'short term'])
                                </div>
                                <!-- target tab -->
                                <div class="tab-pane fade" id="tar-s" role="tabpanel" aria-labelledby="tar-s-tab">
                                    @livewire('target-component', ['National', 'short term'])
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
