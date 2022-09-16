@extends('layouts.app')

@section('content')

    <div class="container">

        <x-breadcrumb model="User"></x-breadcrumb>

        <div class="card">

            <livewire:users/>

        </div>
    </div>

@endsection

@push('custom_js')
    @include('_custom_includes.swal-delete')
@endpush

