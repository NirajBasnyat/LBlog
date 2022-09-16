@extends('layouts.app')

@section('content')

    <x-breadcrumb listRoute="{{route('admin.roles.index')}}" model="Role" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create a New Role</h4><br>

            <x-form.wrapper action="{{route('admin.roles.store')}}" method="POST" enctype="multipart/form-data">

                <x-form.input type="text" label="Name" id="name" name="name" value="{{old('name')}}"/>

                <div class="row">
                    <label class="required col-md-2" for="permissions">Add Permissions</label>
                    <div class="col-md-10">
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-sm btn-info btn-shadow select-all" style="border-radius: 0">Select All</span>
                            <span class="btn btn-sm btn-danger btn-shadow deselect-all" style="border-radius: 0">Remove All</span>
                        </div>
                        <select class="form-control select2" name="permissions[]" id="permissions" multiple>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>
                                    {{ $permission->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-save bx-xs"></i></x-form.button>

            </x-form.wrapper>

        </div>
    </div>

@endsection

@push('custom_js')
    @include('_custom_includes.select2')
@endpush