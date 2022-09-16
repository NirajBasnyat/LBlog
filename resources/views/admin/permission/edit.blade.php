@extends('layouts.app')

@section('content')

    <x-breadcrumb listRoute="{{route('admin.permissions.index')}}" model="Permission" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Permission</h4><br>

            <x-form.wrapper action="{{route('admin.permissions.update', $permission->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.input type="text" label="Name" id="name" name="name" value="{{$permission->name}}"/>
                <br>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-pencil bx-xs"></i></x-form.button>

            </x-form.wrapper>
        </div>
    </div>

@endsection