@extends('layouts.app')

@section('content')

    <x-breadcrumb listRoute="{{route('admin.categories.index')}}" model="Category" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Category</h4><br>

            <x-form.wrapper action="{{route('admin.categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')

                <x-form.input type="text" label="Name" id="name" name="name" value="{{$category->name}}"/>

                <td><img src="{{$category->image}}" alt="cat_image" class="rounded-circle" height="70" width="80"></td>

                <x-form.input type="file" label="Category Image" id="image" name="image"/>

                <x-form.textarea label="Description" id="description" name="description" value="{{$category->description}}"/>

                <x-form.checkbox label="Is_active" id="is_active" name="is_active" value="1" class="form-check-input" isEditMode="yes"
                                 :isChecked="$category->is_active ? 'checked' : '' "/>

                <br>
                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-pencil bx-xs"></i></x-form.button>
            </x-form.wrapper>
        </div>
    </div>

@endsection