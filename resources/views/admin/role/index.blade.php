@extends('layouts.app')

@section('content')

    <div class="container">

        <x-breadcrumb model="Role"></x-breadcrumb>

        <div class="card">

            <livewire:roles/>

        </div>
    </div>

@endsection

@push('custom_js')
    @include('_custom_includes.swal-delete')
@endpush

