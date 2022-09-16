@extends('layouts.app')

@section('content')

    <x-breadcrumb listRoute="{{route('admin.users.index')}}" model="User" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit User</h4><br>

            <x-form.wrapper action="{{route('admin.users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')

                <x-form.input type="text" label="Name" id="name" name="name" value="{{$user->name}}"/>

                <x-form.input type="email" label="Email" id="email" name="email" value="{{$user->email}}"/>

                <x-form.input type="password" label="Password" id="password" name="password"/>

                <x-form.select id="role" name="role" :options="$roles" label="Select Role" model="{{$userRole->name}}"></x-form.select>

                <div id="permissions_box" >
                    <label for="roles">Select Permissions</label>
                    <div id="permissions_checkbox_list">
                    </div>
                </div>

                @if(!empty($user->permissions))
                    @if(!is_null($rolePermissions))
                        <div id="user_permissions_box" >
                            <label for="roles">User Permissions</label>
                            <div id="user_permissions_checkbox_list" class="d-flex flex-wrap">
                                @foreach ($rolePermissions as $permission)
                                    <div class="custom-control custom-checkbox mx-1">
                                        <input class="custom-control-input" type="checkbox" name="permissions[]" id="{{$permission->slug}}" value="{{$permission->id}}" {{ in_array($permission->id, $userPermissions->pluck('id')->toArray() ) ? 'checked="checked"' : '' }}>
                                        <label class="custom-control-label" for="{{$permission->slug}}">{{$permission->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('permissions') <span class="text-danger">{{$message}}</span> @enderror
                    @endif
                @endif

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-pencil bx-xs"></i></x-form.button>

            </x-form.wrapper>

        </div>
    </div>

@endsection

@push('custom_js')
    <script>

        $(document).ready(function(){
            let permissions_box = $('#permissions_box');
            let permissions_checkbox_list = $('#permissions_checkbox_list');
            let user_permissions_box = $('#user_permissions_box');
           // let user_permissions_checkbox_list = $('#user_permissions_checkbox_list');

            permissions_box.hide(); // hide all boxes


            $('#role').on('change', function() {
                let role_id = $(this).find(':selected').val();

                permissions_checkbox_list.empty();
                user_permissions_box.empty();

                $.ajax({
                    url: "{{url('admin/users/create')}}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                    }
                }).done(function(data) {

                    permissions_box.show();
                    // permissions_checkbox_list.empty();

                    $.each(data, function(index, element){
                        $(permissions_checkbox_list).append(
                            '<div class="form-check form-check-success mb-3">' +
                            '<input class="form-check-input" type="checkbox" name="permissions[]" id="' + element.name + '" value="' + element.id + '">' +
                            '<label class="form-check-label" for="' + element.name + '">' + element.name + '</label>' +
                            '</div>'
                        );

                    });
                });
            });
        });

    </script>

@endpush