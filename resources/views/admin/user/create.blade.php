@extends('layouts.app')

@section('content')

    <x-breadcrumb listRoute="{{route('admin.users.index')}}" model="User" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create a New User</h4><br>

            <x-form.wrapper action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">

                <x-form.input type="text" label="Name" id="name" name="name" value="{{old('name')}}"/>

                <x-form.input type="email" label="Email" id="email" name="email" value="{{old('email')}}"/>

                <x-form.input type="password" label="Password" id="password" name="password" value="{{old('password')}}"/>

                <x-form.select id="role" name="role" :options="$roles" label="Select Role"></x-form.select>

                <div id="permissions_box">
                    <label for="roles">Select Permissions</label>

                    <div id="permissions_checkbox_list" class="d-flex flex-wrap"></div>
                    @error('permissions') <span class="text-danger">{{$message}}</span> @enderror

                </div>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-save bx-xs"></i></x-form.button>

            </x-form.wrapper>

        </div>
    </div>


@endsection

@push('custom_js')
    <script>
        $(document).ready(function () {
            let permissions_box = $('#permissions_box');
            let permissions_checkbox_list = $('#permissions_checkbox_list');

            //permissions_box.hide(); // hide all boxes

            $('#role').on('change', function () {
                let role_id = $(this).find(':selected').val();

                permissions_checkbox_list.empty();

                $.ajax({
                    url: "{{url('admin/users/create')}}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                    }
                }).done(function (data) {
                    permissions_box.show();

                    $.each(data, function (index, element) {
                        $(permissions_checkbox_list).append(
                            '<div class="custom-control custom-checkbox mx-1">' +
                            '<input class="custom-control-input" style="margin-right:5px" type="checkbox" name="permissions[]" id="' + element.name + '" value="' + element.id + '">' +
                            '<label class="custom-control-label" for="' + element.name + '">' + element.name + '</label>' +
                            '</div>'
                        );
                    });
                });
            });
        });

    </script>

@endpush