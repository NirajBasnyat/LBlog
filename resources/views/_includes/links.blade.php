<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | {{$setting->short_name ?: 'CMS'}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{$setting->short_name ?: 'CMS'}}" name="{{$setting->description ?: 'A Great CMS System'}}" />
    <meta content="Niraj" name="author" />
    <!-- App favicon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" @if(!is_null($setting) && !is_null($setting->image)) href="{{$setting->image}}" @else
    href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Flag_of_Nepal.svg/800px-Flag_of_Nepal.svg.png"
    @endif>
    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.0/chart.min.js" />
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.0/dist/chart.umd.min.js"></script>
    @livewireStyles
    @stack('custom_css')

</head>

<body data-sidebar="dark">