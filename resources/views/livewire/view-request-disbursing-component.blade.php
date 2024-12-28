<div x-data="data()" class="m-2">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 p-0">
                    <h3>Manage Request Disbursement</h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                            <svg class="stroke-icon">
                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg></a>
                        </li>
                        <li class="breadcrumb-item">Budget Term</li>
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
                            <input type="search" wire:model="search_keyword" class="form-control form-control-sm w-auto" placeholder="Search Implementation...">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            @can('propose implementation request')
                            <a href="{{ route('request-disbursings') }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-plus"></i> Request
                            </a>
                            @endcan

                            @can('print implementation request')

                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="fa fa-print"></i> Print
                            </a>
                            @endcan


                        </div>
                    </div>
                </div>

                <div class="table-responsive custom-scrollbar">
                    <table class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                        <thead class="table-light">
                            <tr class="text-capitalize">
                                <th>SN</th>
                                <th>Project_Title</th>
                                <th>Code</th>
                                <th>Request_Status</th>
                                <th width="220">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $sn =1; @endphp
                            @foreach ($concept_note as $concept)
                                <tr>
                                    <td>{{ $sn }}</td>
                                    <td>{{ $concept->projectname }}</td>
                                    <td>{{ $concept->project_code }}</td>
                                    <td>
                                        @if($concept->process_status == 1)
                                            <span class="badge badge-light-success"> Initiated</span>
                                        @elseif($concept->process_status == 2)
                                            <span class="badge badge-light-success">Verified</span>
                                        @elseif($concept->process_status == 3)
                                            <span class="badge badge-light-success">Submitted</span>
                                        @elseif($concept->process_status == 4)
                                            <span class="badge badge-light-success">Accepted</span>
                                        @elseif($concept->process_status == 5)
                                            <span class="badge badge-light-success">Approved</span>
                                        @elseif($concept->process_status == 6)
                                            <span class="badge badge-light-success">Rejected</span>
                                        @else
                                            <span class="badge badge-light-success">Ongoing</span>
                                        @endif
                                    </td>
                                    <td style="display: flex; gap:5px;">

                                        @can('view implementation request')
                                            <a href="#"  class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modal-request-implementation">View</a>
                                        @endcan

                                        @can('edit implementation request')
                                            <a href="#"  class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-request-implementation">Edit</a>
                                        @endcan

                                        @can('delete implementation request')
                                            <a href="#"  class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modal-request-implementation">Delete</a>
                                        @endcan

                                        @can('comment implementation request')
                                            <a href="#"  class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-request-implementation">Comment</a>
                                        @endcan

                                        @can('initiate implementation request')
                                            <a href="#"  class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal-request-implementation">Initiate</a>
                                        @endcan

                                        @can('submit implementation request')
                                            <a href="#"  class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-request-implementation">Submit</a>
                                        @endcan

                                        @can('receieve implementation request')
                                            <a href="#"  class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal-request-implementation">Received</a>
                                        @endcan

                                    </td>
                                </tr>
                                @php $sn = $sn + 1; @endphp
                            @endforeach
                        </tbody>
                        {{-- <tbody>
                            @forelse ($requestImplementations as $requestImplementation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requestImplementation->year }}</td>
                                    <td>{{ $requestImplementation->start_date }}</td>
                                    <td>{{ $requestImplementation->end_date }}</td>
                                    <td>
                                        <span class="badge {{ $requestImplementation->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($requestImplementation->status) }}
                                        </span>
                                    </td>
                                    <td style="display: flex; gap:5px;">
                                        <a href="#" wire:click="edit({{ $requestImplementation->id }})" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modal-request-implementation">Request</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-danger">No Request Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $requestImplementations->links() }} --}}
                </table>
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
    @push('scripts')
    <script>
       window.livewire.on('closeModal', () => {
                    $('#modal-request-implementation').modal('hide')
                })
    </script>
    @endpush
</div>
