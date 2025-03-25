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
                    <h3>Wasilisha Tukio </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <div class="input-group">
                        <input type="search" wire:model.live="search_keyword"
                            class="form-control form-control-sm w-auto" placeholder="Tafuta taarifa...">
                    </div>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                           data-bs-target="#modal-shehiacommittee"
                        ><i class="fa fa-plus"></i> Tuma Tukio </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive custom-scrollbar">
                <table
                    class="table table-bordered table-sm table-hover table-striped table-responsive custom-scrollbar-sm">
                    <thead class="table-light">
                        <tr class="text-capitalize">
                            <th>SN</th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Aina ya Tukio <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Mahala <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Maelezo <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>

                            <th @click="sortByColumn" class="cursor-pointer select-none">Tarehe iliyowasilishwa <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Imewasilishwa <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>
                            <th @click="sortByColumn" class="cursor-pointer select-none">Hali (status) <span
                                    class="float-end text-secondary">&#8645;</span>
                            </th>
                            <th width="220">Hatua</th>
                        </tr>
                    </thead>
                    <tbody>

                            <tr>
                                <td colspan="8" class="text-center text-danger">No Incidents Found</td>
                            </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
     <!-- Modal Content -->

         <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-shehia" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title"> Weka Taarifa</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4">
                            <label for="name">Chanzo cha Taarifa <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Andika chanzo cha taarifa" readonly>
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="district">Aina <span class="text-danger">*</span></label>
                            <select wire:model="aina" class="form-control @error("aina") is-invalid @enderror" id="aina">
                                <option value="">--Chagua--</option>
                                <option value="Moto">Moto</option>
                                <option value="Mafuriko">Mafuriko</option>
                                <option value="Ajali Angani">Ajali ya Angani</option>
                                <option value="Ajali ya Baharini">Ajali ya Baharini</option>
                                <option value="Ajali ya Barabarani">Ajali ya Barabarani</option>
                                <option value="Maradhi">Maradhi</option>

                            </select>
                            @error("aina")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="name">Thamani (Value) <span class="text-danger">*</span></label>
                            <input type="text" wire:model="thamani" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Andika thamani" readonly>
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status">Kipimo (SI Unit) <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="status">
                                <option value="">--Chagua--</option>
                                <option value="active">Km</option>
                                <option value="inactive">C</option>
                            </select>
                            @error("status")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="name">Chanzo cha Taarifa <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter chanzo cha taarifa" readonly>
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status">Hali <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="status">
                                <option value="">--Chagua--</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error("status")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal" wire:click='create'>Close</button>
                            <button type="button" wire:click.prevent="store"> Tuma</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->
<div class="modal fade" wire:ignore.self id="modal-shehiacommittee" tabindex="-1" role="dialog"
     aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="h6 modal-title">@if($update)
                        Update
                    @else
                        Add
                    @endif Tukio</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="mb-4">
                        <label for="contact_person" class="form-label">Jina lako Kamili<span class="text-danger"> *</span></label>
                        <input type="text" wire:model="contact_person"
                               class="form-control @error("contact_person") is-invalid @enderror"
                               id="contact_person" placeholder="Enter contact person">
                        @error("contact_person")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number" class="form-label">Nambari ya Simu<span class="text-danger"> *</span></label>
                        <input type="text" wire:model="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Andika nambari yako ya simu">
                        @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="tukio" class="form-label">Chagua Tukio<span class="text-danger"> *</span></label>
                        <select wire:model="tukio" class="form-control @error('tukio') is-invalid @enderror">
                            <option value="">--Choose--</option>
                            @foreach ($ainaTukio as $type)
                                <option value="{{ $type['id'] }}">{{ $type['aina_name'] }}</option>
                            @endforeach
                            <!-- Add dynamic options here -->
                        </select>
                        @error('tukio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="mkoa" class="form-label">Chagua Mkoa <span class="text-danger"> *</span></label>
                        <select wire:model="selectedMkoa" class="form-control @error('mkoa') is-invalid @enderror">
                            <option value="">--Choose--</option>
                            @foreach ($mkoas as $region)
                                <option value="{{ $region['mkoa'] }}">{{ $region['mkoa'] }}</option>
                            @endforeach
                            <!-- Add dynamic options here -->
                        </select>
                        @error('mkoa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="wilaya" class="form-label">Chagua Wilaya <span class="text-danger"> *</span></label>
                        @if (!empty($wilayas))
                            <select wire:model="selectedWilaya" class="form-control @error('wilaya') is-invalid @enderror">
                                <option value="">--Choose--</option>
                                @foreach ($wilayas as $wilaya)
                                    <option value="{{ $wilaya['id'] }}">{{ $wilaya['jina'] }}</option>
                                @endforeach
                                <!-- Add dynamic options here -->
                            </select>
                        @endif
                        @error('wilaya')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="shehia" class="form-label">Chagua Shehia <span class="text-danger"> *</span></label>
                        @if (!empty($shehias))
                            <select wire:model="shehia" class="form-control @error('shehia') is-invalid @enderror">
                                <option value="">--Choose--</option>
                                @foreach ($shehias as $shehia)
                                    <option value="{{ $shehia['id'] }}">{{ $shehia['jina'] }}</option>
                                @endforeach
                                <!-- Add dynamic options here -->
                            </select>
                        @endif
                        @error('shehia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                            <label for="latitude" class="form-label">Andika Mtaa/Kijiji/Eneo <span class="text-danger"> *</span></label>
                            <input type="text" wire:model="eneo" class="form-control">
                    </div>
                    <div class="col-md-6">
                            <!-- <label for="latitude" class="form-label">Latitude</label> -->
                            <input type="hidden" wire:model="latitude" class="form-control">
                    </div>
                    <div class="col-md-6">
                            <!-- <label for="longitude" class="form-label">Longitude</label> -->
                            <input type="hidden" wire:model="longitude" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="contact_detail" class="form-label">Maelezo ya Tukio <span class="text-danger"> *</span></label>
                        <textarea wire:model="contact_detail" rows="3" class="form-control @error('contact_detail') is-invalid @enderror"></textarea>
                        @error('contact_detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" wire:click.prevent="store" class="btn btn-secondary"> @if($update)
                                Update
                            @else
                                Add
                            @endif</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Content -->
    <!-- Modal Content -->
    <div class="modal fade" wire:ignore.self id="modal-matukio" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h2 class="h6 modal-title">{{ $update ? 'Badili' : 'Weka' }} Taarifa</h2> --}}
                    {{-- <h2 class="h6 modal-title">{{ $update ? 'Update' : 'Add' }} </h2> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="mb-4">
                            <label for="incident">Aina ya tukio <span class="text-danger">*</span></label>
                            <select wire:model="incident" class="form-control @error('incident') is-invalid @enderror"
                                id="incident">
                                <option value="">--Chagua--</option>
                                {{-- @foreach ($incidentTypes as $incident)
                                    <option value="{{ $incident->id }}">{{ $incident->title }}</option>
                                @endforeach --}}
                            </select>
                            {{-- @error('incident')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror --}}
                        </div>
                        <div class="mb-4">
                            <label for="location">Location <span class="text-danger">*</span></label>
                            <input type="text" wire:model="location"
                                class="form-control @error('location') is-invalid @enderror" id="location"
                                placeholder="Andika Mahala">
                            @error('location')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4 col-md-12 col-sm-12 col-lg-12" xmlns="http://www.w3.org/1999/html">
                            <label for="description">Maelezo <span class="text-danger">*</span></label>
                            <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                placeholder="Enter description" rows="4">
                            </textarea>
                            @error('descriptioKuna moto Fuoni Mambosasa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status">Hali <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error('status') is-invalid @enderror"
                                id="status">
                                <option value="">--Chagua--</option>
                                <option value="Imeanzishwa">Imeanzishwa </option>
                                <option value="Inaendelea">Inaendelea</option>
                                <option value="Imetatuliwa">Imetatuliwa</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal"
                                wire:click='create'>Close</button>
                            <button type="button" wire:click.prevent="store"
                                class="{{ $update ? 'btn btn-success' : 'btn btn-primary' }}">
                                {{ $update ? 'Update' : 'Add' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal Content -->

    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModalshehia" data-backdrop="false" tabindex="-1"
        role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm </h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete <strong></strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="destroy()" class="btn btn-danger close-modal"
                        data-bs-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" wire:ignore.self id="modal-shehia" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="h6 modal-title"> Weka Taarifa</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div  class="row">
                        <div class="mb-4">
                            <label for="name">Chanzo cha Taarifa <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Andika chanzo cha taarifa" readonly>
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="district">Aina <span class="text-danger">*</span></label>
                            <select wire:model="aina" class="form-control @error("aina") is-invalid @enderror" id="aina">
                                <option value="">--Chagua--</option>
                                <option value="Moto">Moto</option>
                                <option value="Mafuriko">Mafuriko</option>
                                <option value="Ajali Angani">Ajali ya Angani</option>
                                <option value="Ajali ya Baharini">Ajali ya Baharini</option>
                                <option value="Ajali ya Barabarani">Ajali ya Barabarani</option>
                                <option value="Maradhi">Maradhi</option>

                            </select>
                            @error("aina")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="name">Thamani (Value) <span class="text-danger">*</span></label>
                            <input type="text" wire:model="thamani" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Andika thamani" readonly>
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status">Kipimo (SI Unit) <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="status">
                                <option value="">--Chagua--</option>
                                <option value="active">Km</option>
                                <option value="inactive">C</option>
                            </select>
                            @error("status")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="name">Chanzo cha Taarifa <span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="Enter chanzo cha taarifa" readonly>
                            @error("name")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status">Hali <span class="text-danger">*</span></label>
                            <select wire:model="status" class="form-control @error("status") is-invalid @enderror" id="status">
                                <option value="">--Chagua--</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error("status")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal" wire:click='create'>Close</button>
                            <button type="button" wire:click.prevent="store"> Tuma</button>
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
                                !isNaN(row2) ?
                                row1 - row2 :
                                row1.toString().localeCompare(row2);
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
                    $('#modal-matukio').modal('hide')
                });
            });
        </script>
    @endpush
</div>
