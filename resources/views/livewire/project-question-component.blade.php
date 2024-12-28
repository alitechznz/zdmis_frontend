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
    </style>


<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6 p-0">
                <h3>Manage Screening Question</h3>
            </div>
            {{-- <div class="col-sm-6 p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a></li>
                    <li class="breadcrumb-item">Project Question</li>
                </ol>
            </div> --}}
        </div>
    </div>
</div>

<div class="container-fluid default-dashboard">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">

                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword" class="form-control form-control-sm w-auto"
                               placeholder="Search project question...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        @can('add screening question')
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-projectquestion" wire:click='create'
                            ><i class="fa fa-plus"></i> Add New </a>
                        @endcan
                       
                    </div>

                </div>


            </div>

            <div class="table-responsive custom-scrollbar">
                <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                    <tr class="text-capitalize">
                        <th @click="sortByColumn" class="cursor-pointer select-none">SN <span class="float-end text-secondary">&#8645;</span>
                        <th @click="sortByColumn" class="cursor-pointer select-none">Section_Title <span class="float-end text-secondary">&#8645;</span>
                        </th><th @click="sortByColumn" class="cursor-pointer select-none">Question <span class="float-end text-secondary">&#8645;</span>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Score_Weight <span class="float-end text-secondary">&#8645;</span>
                        </th>
                        <th width="220">Actions</th>
                    </tr>
                    </thead>
                    <tbody x-ref="tbody">
                    @forelse ($projectquestions as $projectquestion)
    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $projectquestion->section }}</td>
                        <td>{{ $projectquestion->title }}</td>
                        <td>{{ $projectquestion->score_weight }}</td>
                        <td style="display: flex; gap:5px;">
                            @can('edit screening question')
                            <a href="#" wire:click="edit({{ $projectquestion->id }})"
                                class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-projectquestion">
                                 Edit </a>
                            @endcan
                            
                            @can('delete screening question')
                                <a href="#" class="btn btn-sm btn-danger" wire:click="deleteConfirm({{$projectquestion->id}})" data-bs-toggle="modal" data-bs-target="#deleteModalprojectquestion">
                                        Delete </a>
                            @endcan
                            
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-danger text-center"> No Screening Question Found</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $projectquestions->links() }}
            </div>

        </div>
    </div>

</div>







    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-projectquestion" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title">@if($update) Update @else Add @endif Screening Question</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="title">Question <span class="text-danger">*</span></label>
                            <input type="text" wire:model="title" class="form-control @error("title") is-invalid @enderror" id="title" placeholder="Enter Question">
                            @error("title")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="section">Section Title <span class="text-danger">*</span></label>
                            <input type="text" wire:model="section" class="form-control @error("section") is-invalid @enderror" id="section" placeholder="Enter Section Title">
                            @error("section")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="sub_section">Sub Section Title</label>
                            <input type="text" wire:model="sub_section" class="form-control @error("sub_section") is-invalid @enderror" id="sub_section" placeholder="Enter Sub Section">
                            @error("sub_section")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <!-- Hidden page input -->
                        <input type="hidden" wire:model="page" value="screening">

                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="number">Question Number <span class="text-danger">*</span></label>
                            <input type="number" wire:model="number" class="form-control @error("number") is-invalid @enderror" id="number" placeholder="Enter Question Number">
                            @error("number")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <div class="mb-4 col-md-6 col-sm-6 col-lg-6">
                            <label for="section_number">Section Number <span class="text-danger">*</span></label>
                            <input type="number" wire:model="section_number" class="form-control @error("section_number") is-invalid @enderror" id="section_number" placeholder="Enter Section Number">
                            @error("section_number")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12">
                            <label for="score_weight">Question Score Weight</label>
                            <input type="number" wire:model="score_weight" class="form-control @error("score_weight") is-invalid @enderror" id="score_weight" placeholder="Enter Score Weight">
                            @error("score_weight")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal" wire:click='create'>Close</button>
                            <button type="button" wire:click.prevent="store" class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">  {{ $update ? 'Update' : 'Add' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalprojectquestion" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong>{{ $delete_confirm? $delete_confirm->name: ''  }}</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
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
    @push('scripts')
    <script>
       document.addEventListener('livewire:initialized', () => {
                @this.on('closeModal', (event) => {
                    $('#modal-projectquestion').modal('hide')
                });
                });
    </script>
    @endpush
</div>
