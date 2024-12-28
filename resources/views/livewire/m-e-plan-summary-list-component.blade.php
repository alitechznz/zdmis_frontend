<div x-data="data()" class="m-2">
    <style>
        .compact .btn {
            padding-bottom: 1.3pt;
            padding-top: 1.3pt;
        }

        .compact td, .compact th {
            padding: 4px 8px;
        }
    </style>

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 p-0">
                <h3>M & E Plan Summary</h3>
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
    <div class="container-fluid">
        {{-- <div class="page-title">
            <h3>M & E Plan</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item active">M & E Plan Summary</li>
            </ol>
        </div> --}}
        <div class="card">
            <div class="card-body">
                <form class="mb-4">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="projectName" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="projectName" value="Health Improvement Project" readonly>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="projectCode" class="form-label">Code</label>
                            <input type="text" class="form-control" id="projectCode" value="HIP2024" readonly>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="startDate" value="2024-12-01" readonly>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="endDate" value="2024-12-30" readonly>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <label for="meStatus" class="form-label">M & E Status</label>
                            <input type="text" class="form-control" id="meStatus" value="Active" readonly>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <label for="remarks" class="form-label">Remarks</label>
                            <textarea id="remarks" class="form-control" rows="3" readonly>Initial setup and preparation completed.</textarea>
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <label for="totalCost" class="form-label">Total Cost</label>
                            <input type="text" class="form-control" id="totalCost" value="Tsh 50,000, 000" readonly>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered table-sm table-hover table-striped compact">
                    <thead class="table-light">
                        <tr class="text-uppercase">
                            <th>SN</th>
                            <th>KPI Indicator</th>
                            <th>KPI</th>
                            <th>KPI Definition</th>
                            <th>Baseline</th>
                            <th>Target</th>
                            <th>Data Source</th>
                            <th>Frequency</th>
                            <th>Responsible</th>
                        </tr>
                    </thead>
                    <tbody x-ref="tbody">
                        <tr>
                            <td>1</td>
                            <td>Health Coverage</td>
                            <td>% of population</td>
                            <td>Percentage of the regional population covered by health services</td>
                            <td>70%</td>
                            <td>85%</td>
                            <td>Regional Health Database</td>
                            <td>Quarterly</td>
                            <td>ZURA</td>
                        </tr>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function data() {
            return {
                sortBy: "",
                sortAsc: false,
                sortByColumn($event) {
                    if (this.sortBy === $event.target.innerText) {
                        if (this.sortAsc) {
                            this.sortBy = "";
                            this.sortAsc = false;
                        } else {
                            this.sortAsc = !this.sortAsc;
                        }
                    } else {
                        this.sortBy = $event.target.innerText;
                    }

                    this.getTableRows().sort(this.sortCallback(
                        Array.from($event.target.parentNode.children).indexOf($event.target))).forEach((tr) => {
                        this.$refs.tbody.appendChild(tr);
                    });
                },
                getTableRows() {
                    return Array.from(this.$refs.tbody.querySelectorAll("tr"));
                },
                getCellValue(row, index) {
                    return row.children[index].innerText;
                },
                sortCallback(index) {
                    return (a, b) => ((row1, row2) => {
                        return row1 !== "" && row2 !== "" && !isNaN(row1) && !isNaN(row2) ? row1 - row2 : row1.toString().localeCompare(row2);
                    })(this.getCellValue(this.sortAsc ? a : b, index), this.getCellValue(this.sortAsc ? b : a, index));
                }
            };
        }
    </script>
    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-region').modal('hide');
                });
            });
        </script>
    @endpush
</div>
