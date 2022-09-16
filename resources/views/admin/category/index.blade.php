@extends('layouts.app')

@section('content')

    <div class="container">

        <x-breadcrumb model="Category"></x-breadcrumb>

        <div class="card">

           <livewire:categories />

        </div>
    </div>

@endsection

@push('custom_js')

    @include('_custom_includes.swal-delete')

@endpush