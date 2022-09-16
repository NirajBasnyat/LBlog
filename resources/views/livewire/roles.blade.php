<div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <p class="lead m-0"><strong>Role List</strong></p>

            <x-datatable-item route="{{route('admin.roles.create')}}" can-create="add-role"/>
        </div>
        <br>

        <table id="datatable" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Permissions</th>
                @canany(['delete-role','edit-role'])
                    <th>Action</th>@endcanany
            </tr>
            </thead>

            <tbody>

            @forelse ($roles as $role)
                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{$role->name}}</td>

                    <td>{{$role->slug}}</td>

                    <td>
                        @forelse($role->permissions as $permission)
                            <span class="badge badge-soft-primary">{{$permission->name}}</span>
                        @empty
                            <span class="badge badge-danger">No Permissions</span>
                        @endforelse
                    </td>

                    <td class="d-flex">
                        @can('delete-role')
                            <x-list.delete route-destroy="{{route('admin.roles.destroy', $role->id ) }}"/>
                        @endcan

                        @can('edit-role')
                            <x-list.edit route-edit="{{route('admin.roles.edit', $role->id) }}"/>
                        @endcan
                    </td>

                </tr>

            @empty
                <td>No record</td>
            @endforelse

            </tbody>
        </table>

        {{$roles->links() }}
    </div>
</div>
