<div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <p class="lead m-0"><strong>Permission List</strong></p>

            <x-datatable-item route="{{route('admin.permissions.create')}}" can-create="add-permission"/>
        </div>

        <br>

        <table id="datatable" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

            <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Slug</th>
                @canany(['delete-permission','edit-permission'])<th>Action</th>@endcanany
            </tr>
            </thead>

            <tbody>

            @forelse ($permissions as $permission)
                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{$permission->name}}</td>

                    <td>{{$permission->slug}}</td>

                    <td class="d-flex">
                        @can('delete-permission')
                            <x-list.delete route-destroy="{{route('admin.permissions.destroy', $permission->id ) }}"/>
                        @endcan

                        @can('edit-permission')
                            <x-list.edit route-edit="{{route('admin.permissions.edit', $permission->id) }}"/>
                        @endcan
                    </td>

                </tr>

            @empty
                <td>No record</td>
            @endforelse

            </tbody>
        </table>

        {{$permissions->links() }}

    </div>
</div>