@extends('layouts.app')

@section('content')

    <div class="container">

        <x-breadcrumb model="Permission"></x-breadcrumb>

        <div class="card">

            <livewire:permissions/>

        </div>
    </div>

@endsection

@push('custom_js')
    @include('_custom_includes.swal-delete')
@endpush

