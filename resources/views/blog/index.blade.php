@extends('layouts.app')

@section('content')

    <div class="container">

        <x-breadcrumb model="Blog"></x-breadcrumb>

        <div class="card">

            <livewire:blogs />

        </div>
    </div>

@endsection

@push('custom_js')

    @include('_custom_includes.swal-delete')

@endpush
