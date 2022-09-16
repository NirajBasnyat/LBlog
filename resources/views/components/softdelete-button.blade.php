<td class="d-flex">
    <div class="float-right px-2">

        @if(isset($routeRestore))
            <form action="{{$routeRestore}}" method="POST">
                @csrf

                <button class="btn btn-info btn-sm btn-restore" type="submit">
                    Restore
                </button>
            </form>
        @endif
    </div>

    <div>
        @if(isset($routeForceDelete))
            <form action="{{$routeForceDelete}}" method="POST">
                @csrf

                <button class="btn btn-danger btn-sm btn-force-delete">
                    Delete Permanently
                </button>
            </form>
        @endif
    </div>
</td>