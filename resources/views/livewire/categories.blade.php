<div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <p class="lead m-0"><strong>Category List</strong>
                @can('access-archive-category-list')
                    <a href="{{route('admin.category.trashed')}}" class="btn btn-sm btn-info">Achieved Categories</a>
                @endcan
            </p>

            <x-datatable-item route="{{route('admin.categories.create')}}" can-create="add-category"/>

        </div>
        <br>

        <table id="datatable" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

            <thead>
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                @can('change-category-status')
                    <th>Status</th>
                @endcan
                @canany(['delete-category','edit-category'])
                    <th>Action</th>
                @endcanany
            </tr>
            </thead>

            <tbody>

            @forelse ($categories as $category)
                <tr class="row1" data-id="{{ $category->id }}">
                    <td>{{$loop->iteration}}</td>

                    <td>{{$category->name}}</td>

                    <td>{{$category->slug}}</td>

                    <td><img src="{{$category->image}}" alt="cat_image" class="rounded-circle" height="40" width="40"></td>

                    @can('change-category-status')
                        <td>
                            <div class="form-check form-switch mb-3" dir="ltr">
                                @livewire('toggle-switch',['model'=> $category,'field' => 'is_active'], key($category->id))
                            </div>

                        </td>
                    @endcan


                    <td class="d-flex">
                        @can('delete-category')
                            <x-list.delete route-destroy="{{route('admin.categories.destroy', $category->id ) }}"/>
                        @endcan

                        @can('edit-category')
                            <x-list.edit route-edit="{{route('admin.categories.edit', $category->id) }}"/>
                        @endcan
                    </td>

                </tr>

            @empty
                <td>No record</td>
            @endforelse

            </tbody>
        </table>
        {!! $categories->links() !!}

    </div>
</div>
