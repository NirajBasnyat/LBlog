<div class="float-right px-2">
    @if(isset($routeDestroy))
        <form action="{{$routeDestroy}}" method="POST">
            @csrf
            @method('Delete')

            <button class="btn btn-default btn-sm btn-delete"
                    type="submit" title="Delete">
                <i class="mdi mdi-delete text-danger font-size-18"></i>
            </button>
        </form>
    @endif
</div>