<div>
    <div class="card-body py-0 pt-4">
        <div class="d-flex justify-content-between">
            <p class="lead m-0 pb-2"><strong>User List</strong></p>

            <x-datatable-item route="{{route('admin.users.create')}}" can-create="add-user"/>
        </div>
    </div>

    <table id="datatable" class="table">
        <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Email</th>
            {{-- <th>Is Admin</th>--}}
            <th>Permissions</th>
            @canany(['delete-user','edit-user'])<th>Action</th>@endcanany
        </tr>
        </thead>

        <tbody>

        @forelse ($users as $user)
            <tr>
                <td>{{$loop->iteration}}</td>

                <td>{{$user->name}}</td>

                <td>{{$user->email}}</td>
                {{-- <td>{{$user->user_type }}</td>--}}

                <td>
                    @forelse($user->permissions as $permission)
                        <span class="badge badge-soft-primary">{{$permission->name}}</span>
                    @empty
                        <span class="badge badge-danger">No Permissions</span>
                    @endforelse
                </td>

                <td class="d-flex">
                    @can('delete-user')
                        <x-list.delete route-destroy="{{route('admin.users.destroy', $user->id ) }}"/>
                    @endcan

                    @can('edit-user')
                        <x-list.edit route-edit="{{route('admin.users.edit', $user->id) }}"/>
                    @endcan
                </td>

            </tr>

        @empty
            <td>No record</td>
        @endforelse

        </tbody>
    </table>

    {{$users->links() }}
</div>
