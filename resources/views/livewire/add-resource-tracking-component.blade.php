<div x-data="data()" class="m-2">
    <style>
        .compact .btn {
            padding-bottom: 1.3pt;
            padding-top: 1.3pt;
        }

        .compact td {
            padding-bottom: 1.3pt;
            padding-top: 1.3pt;
        }
        .card-footer.bg-white {
            border-top: 1px solid #dee2e6;
            background-color: #fff;
            padding: 1rem;
        }

</style>

<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 p-0">
                <h3>Implementation Reporting Form</h3>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid default-dashboard">

  <!-- Resource Tracking -->
  @livewire('implementation-request.resource-tracking-component')

    <div class="card mt-5">
        <div class="card-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Implementation Report</h3>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">

                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="source_financing">Planned Activity <span class="text-danger">*</span></label>
                    <select wire:model="source_financing" class="form-control @error("source_financing") is-invalid @enderror" id="source_financing">
                        <option value="">--Choose--</option>
                            <option value="Activity One">Activity One</option>
                            <option value="Activity Two">Activity Two</option>
                            <option value="Activity Three">Activity Thee</option>
                    </select>
                    @error("source_financing")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                    <label for="source_financing">Indicators <span class="text-danger">*</span></label>
                    <select wire:model="source_financing" class="form-control @error("source_financing") is-invalid @enderror" id="source_financing">
                        <option value="">--Choose--</option>
                            <option value="Activity One">KPI A</option>
                            <option value="Activity Two">KPI B</option>
                            <option value="Activity Three">KPI C</option>
                    </select>
                    @error("source_financing")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-12">
                    <label for="remark">Actual Implementation <span class="text-danger">*</span></label>
                    <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter Actual Implementation"></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="amount">% of Implementation <span class="text-danger">*</span></label>
                    <input type="text" wire:model="amount" class="form-control @error("amount") is-invalid @enderror" id="amount" placeholder="Enter % of Implementation">
                    @error("amount")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="row mb-5">
                    <div class="col-12 text-end">
                        <button type="button" wire:click.prevent="store" class="btn btn-primary">Add</button>
                    </div>
                </div>

                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped compact">
                        <thead class="table-light">
                        <tr class="text-capitalize">
                            <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                                <th @click="sortByColumn" class="cursor-pointer select-none">Annual_Planned_Activities <span class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Planned_Activities_for_the_Quarter <span class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Actual_Implementation <span class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Indicator <span class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Baseline <span class="float-end text-secondary">&#8645;</span>
                            </th>


                            <th width="220">Actions</th>
                        </tr>
                        </thead>
                        <tbody x-ref="tbody">

                        <tr>
                            <td>1</td>
                            <td>Particular A</td>
                            <td>Source A</td>
                            <td>Quertely</td>
                            <td>Amount</td>
                            <td>Baseline</td>

                            <td style="display: flex; gap: 5px;">
                               @can('edit implementation report')
                                <a href="" class="btn btn-sm btn-success">Edit </a>
                               @endcan

                                @can('delete implementation report')
                                    <a href="" class="btn btn-sm btn-danger"> Delete</a>
                                @endcan

                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>




                <hr>
                <div class="mb-4">
                    <div class="card-header text-uppercase" style="font-weight: bold">Activity which were not Implemented Section</div>
                </div>

                <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                    <label for="source_financing">Planned Activity were not Implemented <span class="text-danger">*</span></label>
                    <select wire:model="source_financing" class="form-control @error("source_financing") is-invalid @enderror" id="source_financing">
                        <option value="">--Choose--</option>
                            <option value="Activity One">Activity One</option>
                            <option value="Activity Two">Activity Two</option>
                            <option value="Activity Three">Activity Thee</option>
                    </select>
                    @error("source_financing")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="mb-4 col-12">
                    <label for="remark">Remark <span class="text-danger">*</span></label>
                    <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Type your remark"></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



            </div>


            <div class="row">
                <div class="col-12 text-end">
                    <button type="button" wire:click.prevent="store" class="btn btn-primary">Add</button>
                </div>
            </div>


            <div class="table-responsive custom-scrollbar my-5">
                <table class="table table-bordered table-sm table-hover table-striped compact">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Annual_Planned_Activities <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Planned_Activities_for_the_Quarter <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Actual_Implementation <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Indicator <span class="float-end text-secondary">&#8645;</span>
                        </th>

                        <th @click="sortByColumn" class="cursor-pointer select-none">Baseline <span class="float-end text-secondary">&#8645;</span>
                        </th>



                        <th width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">

                    <tr>
                        <td>1</td>
                        <td>Particular A</td>
                        <td>Source A</td>
                        <td>Quertely</td>
                        <td>Amount</td>
                        <td>Baseline</td>

                        <td style="display: flex; gap: 5px;">
                           @can('edit activity report')
                            <a href="" class="btn btn-sm btn-success"> Edit</a>
                           @endcan

                            @can('delete activity report')
                                <a href="" class="btn btn-sm btn-danger"> Delete</a>
                            @endcan

                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="row mt-5">
                <div class="mb-4 col-12">
                    <label for="remark">Q1: Write Challenges during the implementation of the program/project for the period of report <span class="text-danger">*</span></label>
                    <textarea wire:model="remark"  cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Enter the Challenges"></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-4 col-12">
                    <label for="remark">Q2: Rcommendations <span class="text-danger">*</span></label>
                    <textarea wire:model="remark" cols="4" rows="8" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Type your Rcommendations"></textarea>
                    @error("remark")
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



            </div>

            <div class="row">
                <div class="col-12 text-end">
                    <button type="button" wire:click.prevent="store" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card mt-5">
        <div class="card-body">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 p-0">
                            <h3>Decision Making</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                        <label for="action">Action <span class="text-danger">*</span></label>
                        <select wire:model="action" class="form-control @error('action') is-invalid @enderror" id="action">
                            <option value="">--Choose--</option>
                            <option value="accept">Accept</option>
                            <option value="reject">Reject</option>
                        </select>
                        @error("action")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>



                    <div class="mb-4 col-12">
                        <label for="remark">Remark <span class="text-danger">*</span></label>
                        <textarea wire:model="remark" cols="4" rows="6" class="form-control @error('remark') is-invalid @enderror" id="remark" placeholder="Type your remark"></textarea>
                        @error("remark")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <!-- Buttons with Icons -->
                    <div class="col-12 text-end">
                        @can('finish resource tracking')
                        <button type="button" class="btn btn-primary">
                            <i class="fa fa-flag-checkered"></i> Finish
                        </button>
                        @endcan

                        @can('verify resource tracking')
                        <button type="button" class="btn btn-secondary">
                            <i class="fa fa-check-circle"></i> Verify
                        </button>
                        @endcan

                        @can('submit resource tracking')
                        <button type="button" class="btn btn-success">
                            <i class="fa fa-paper-plane"></i> Submit
                        </button>
                        @endcan

                        @can('receive resource tracking')
                        <button type="button" class="btn btn-info">
                            <i class="fa fa-inbox"></i> Received
                        </button>
                        @endcan

                        @can('open resource tracking')
                        <button type="button" class="btn btn-warning">
                            <i class="fa fa-folder-open"></i> Open
                        </button>
                        @endcan
                        @can('approved resource tracking')
                        <button type="button" class="btn btn-danger">
                            <i class="fa fa-thumbs-up"></i> Approved
                        </button>
                        @endcan

                    </div>
                </div>
            </div>
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

                    this.getTableRows()
                        .sort(
                            this.sortCallback(
                                Array.from($event.target.parentNode.children).indexOf(
                                    $event.target
                                )
                            )
                        )
                        .forEach((tr) => {
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
                    return (a, b) =>
                        ((row1, row2) => {
                            return row1 !== "" &&
                            row2 !== "" &&
                            !isNaN(row1) &&
                            !isNaN(row2)
                                ? row1 - row2
                                : row1.toString().localeCompare(row2);
                        })(
                            this.getCellValue(this.sortAsc ? a : b, index),
                            this.getCellValue(this.sortAsc ? b : a, index)
                        );
                }
            };
        }
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const projectSelect = document.getElementById('project');
        const projectCodeInput = document.getElementById('project_code');

        projectSelect.addEventListener('change', function() {
            const projectId = this.value;
            projectCodeInput.value = 'Loading...';  // Optional: Set a loading message

            // Fetch project code from the server
            fetch(`get-project-code/${projectId}`)  // Adjust the URL to match your route
                .then(response => response.json())
                .then(data => {
                    // Set the project code or "Not Assigned" if the project_code is empty or undefined
                    projectCodeInput.value = data.project_code || 'Not Assigned';
                })
                .catch(error => {
                    console.error('Error fetching project code:', error);
                    projectCodeInput.value = 'Error fetching project code';  // Set "Not Assigned" if there's an error
                });
        });
    });
</script>



<script>
    function isNumberKey(evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      // Allow only numeric keys and backspace, delete, left & right arrows, enter and tab
      if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105) && [8, 37, 39, 46, 9, 13].indexOf(charCode) === -1)
          return false;
      return true;
  }

  function formatNumber(input) {
      let value = input.value.replace(/,/g, '');
      let formatted = Number(value).toLocaleString();
      if (!isNaN(parseFloat(value)) && isFinite(value)) {
          input.value = formatted;
      }
  }

  </script>

    @push('scripts')
    <script>
       document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-resourcetracking').modal('hide')
                });
                });
    </script>
    @endpush
</div>
