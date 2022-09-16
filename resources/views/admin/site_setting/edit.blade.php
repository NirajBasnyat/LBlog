@extends('layouts.app')

@section('content')

    <x-breadcrumb model="Site Setting"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit SiteSetting</h4><br>

            <x-form.wrapper action="{{route('admin.site-settings.update', $site_setting->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                <x-form.input type="file" label="Site Image" id="site_image" name="image"/>
                <x-form.input type="text" label="Full Name" id="full_name" name="full_name" value="{{$site_setting->full_name}}"/>
                <x-form.input type="text" label="Short Name" id="short_name" name="short_name" value="{{$site_setting->short_name}}"/>
                <x-form.input type="email" label="Email" id="email" name="email" value="{{$site_setting->email}}"/>
                <x-form.input type="text" label="Footer Text" id="footer_text" name="footer_text" value="{!! $site_setting->footer_text !!}"/>
                <x-form.input type="text" label="Phone Number" id="phone_number" name="phone_number" value="{{$site_setting->phone_number}}"/>
                <x-form.textarea label="Description" id="description" name="description" value="{{$site_setting->description}}" rows="5" cols="5"/>

                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class="bx bx-pencil bx-xs"></i></x-form.button>

            </x-form.wrapper>
        </div>
    </div>

@endsection