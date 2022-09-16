@extends('layouts.app')

@section('content')

    <div>
        <x-breadcrumb listRoute="{{route('admin.categories.index')}}" model="Category" item="Trashed"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="lead m-0"><strong>Trashed Category List</strong></p>

                </div>
                <br>

                <table id="datatable" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Visibility</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse ($categories as $category)
                        <tr class="row1" data-id="{{ $category->id }}">
                            <td>{{$loop->iteration}}</td>

                            <td>{{$category->name}}</td>

                            <td>{{$category->slug}}</td>

                            <td><img src="{{$category->image}}" alt="cat_image" class="rounded-circle" height="40" width="40"></td>

                            @can('change-category-status')
                                <td>
                                    <div class="form-check form-switch mb-3" dir="ltr">
                                        @livewire('toggle-switch',['model'=> $category,'field' => 'is_active'], key($category->id))
                                    </div>

                                </td>
                            @endcan

                            @can('access-archive-category-button')
                                @if($category->trashed())
                                    <x-softdelete-button routeRestore="{{route('admin.category.restore', $category->id ) }}"
                                                         routeForceDelete="{{route('admin.category.force_delete', $category->id) }}">
                                    </x-softdelete-button>
                                @endif
                            @endcan


                        </tr>

                    @empty
                        <td>No record</td>
                    @endforelse

                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')

    @include('_custom_includes.swal-delete')

@endpush
