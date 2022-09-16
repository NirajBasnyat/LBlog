@extends('layouts.app')

@section('content')

    <div>
        <x-breadcrumb listRoute="{{route('blogs.index')}}" model="Blog" item="Trashed"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <p class="lead m-0"><strong>Trashed Blog List</strong></p>
                </div>
                <br>

                <table id="datatable" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse ($blogs as $blog)
                        <tr class="row1" data-id="{{ $blog->id }}">
                            <td>{{$loop->iteration}}</td>

                            <td>{{$blog->title}}</td>

                            @can('access-archive-category-button')
                                @if($blog->trashed())
                                    <x-softdelete-button routeRestore="{{route('blog.restore', $blog->id ) }}"
                                                         routeForceDelete="{{route('blog.force_delete', $blog->id) }}">
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
