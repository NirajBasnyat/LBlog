@extends('layouts.app')

@section('content')

    <div class="container">

        <x-breadcrumb listRoute="{{route('blogs.index')}}" model="Blog" item="Show"></x-breadcrumb>

        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">

                <h2 class="text-center text-black text-capitalize">{{$blog->title}}</h2>
                <br>
                <hr>
                <h3><strong>Categories</strong>:</h3>

                @foreach($blog->categories as $category)
                    <button class="btn btn-sm btn-dark">{{$category->name}}</button>
                @endforeach
                <hr>
                {!! $blog->content!!}
            </div>
        </div>
    </div>

@endsection
