@extends('layouts.app')

@section('content')

    <x-breadcrumb listRoute="{{route('admin.categories.index')}}" model="Category" item="Create"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create a New Category</h4><br>

            <x-form.wrapper action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">

                <x-form.input type="text" label="Name" id="name" name="name" value="{{old('name')}}"/>

                <x-form.input type="file" label="Category Image" id="image" name="image"/>

                <x-form.textarea label="Description" id="description" name="description" value="{{old('description')}}"/>

                <x-form.checkbox label="Is Active" id="is_active" name="is_active" value="1" class="form-check-input"/><br>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-save bx-xs"></i></x-form.button>

            </x-form.wrapper>

        </div>
    </div>


@endsection