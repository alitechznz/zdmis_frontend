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
                    <h3>Kuingiza TMA Taarifa </h3>
                </div>
                {{-- <div class="col-sm-6 p-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">
                                <svg class="stroke-icon">
                                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Districts</li>
                    </ol>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-4">

                </div>
                <div class="col-8">
                    <div class="float-end">
                        <form wire:submit.prevent="saveData">
                            <input type="file" wire:model="pdf">
                            <button type="submit">Upload and Extract Data</button>
                        </form>

                    </div>

                </div>
            </div>
            <div class="table-responsive">
                @if ($weatherData)
                <div class="mt-4">
                    <h3>Extracted Weather Data</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>City</th>
                                <th>High Temp (°C)</th>
                                <th>Low Temp (°C)</th>
                                <th>Sunrise Time</th>
                                <th>Sunset Time</th>
                                <th>Winds</th>
                                <th>Waves</th>
                                <th>Warnings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($weatherData as $data)
                                <tr>
                                    <td>{{ $data->city }}</td>
                                    <td>{{ $data->high_temp }}</td>
                                    <td>{{ $data->low_temp }}</td>
                                    <td>{{ $data->sunrise_time }}</td>
                                    <td>{{ $data->sunset_time }}</td>
                                    <td>{{ $data->wind }}</td>
                                    <td>{{ $data->waves }}</td>
                                    <td>{{ $data->warnings }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
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
                    $('#modal-district').modal('hide')
                });
            });
        </script>
    @endpush
</div>
