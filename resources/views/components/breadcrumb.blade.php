<div class="page-title-right">
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
        <li class="breadcrumb-item {{ !isset($item) ? 'active' : ''}}"><a href="{{isset($listRoute) ? $listRoute : 'javascript::void(0)'}}">{{$model}}</a></li>

        @if(isset($item))
            <li class="breadcrumb-item active">{{$item}} {{$model}}</li>
        @endif
    </ol>
</div>

