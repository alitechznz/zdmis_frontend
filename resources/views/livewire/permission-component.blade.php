<div>
    <div class="accordion" id="accordionExample">
        <h3>Permissions for <strong>{{ $role?->name }}</strong></h3>
        <div class="row">
            <div class="col">
                <a class="btn btn-sm btn-success float-end" wire:click="store"><i class="fa fa-save"></i> Save Changes </a>
            </div>
        </div>

        @foreach($groups as $group)
            <div class="card my-2 border-0">
                <div class="border border-light-primary" id="heading{{ $loop->index }}" style="background: #3c4b64">
                    <h4 class="m-2 text-white-50 text-capitalize">
                        <i class="fas fa-arrow-alt-circle-down"></i> {{ $group->group }}
{{--                        <input type="button" class="select-all-checkbox btn btn-sm btn-secondary float-end" value="Select All" data-group="{{ $group->group }}">--}}
                    </h4>
                </div>
                <div class="row">
                    <div class="card-body row">
                        @foreach($permissions as $permission)
                            @if( $group->group == $permission->group)
                                <div class="col-6 py-0 ml-3 d-block">
                                    <input type="checkbox" class="form-check-input"
                                           wire:model.defer="selected_permissions"
                                           id="{{$permission->id}}"
                                           value="{{$permission->name}}"
                                           name="permissions[]">
                                    <label for="{{$permission->id}}" class="fs-6"> {{ucfirst($permission->name)}}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        @can('sync permission')
            <div class="row">
                <div class="col">
                    <a class="btn btn-sm btn-success float-end" wire:click="store"><i class="fa fa-save"></i> Save Changes </a>
                </div>
            </div>
        @endcan

    </div>
</div>
