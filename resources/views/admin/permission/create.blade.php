@extends('layouts.app')

@section('content')

    <x-breadcrumb listRoute="{{route('admin.permissions.index')}}" model="Permission" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create a New Permission</h4><br>

            <x-form.wrapper action="{{route('admin.permissions.store')}}" method="POST" enctype="multipart/form-data">
                <x-form.input type="text" label="Name" id="name" name="name" value="{{old('name')}}"/>
                <br>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-save bx-xs"></i></x-form.button>
            </x-form.wrapper>

        </div>
    </div>

@endsection