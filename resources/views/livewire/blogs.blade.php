<div>
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <p class="lead m-0"><strong>Blog List</strong>
                @can('access-archive-blog-list')
                    <a href="{{route('blog.trashed')}}" class="btn btn-sm btn-info">Achieved Blogs</a>
                @endcan
            </p>

            <x-datatable-item route="{{route('blogs.create')}}" can-create="add-blog"/>

        </div>
        <br>

        <table id="datatable" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

            <thead>
            <tr>
                <th>SN</th>
                <th>title</th>
                @canany(['delete-blog','edit-blog'])
                    <th>Action</th>
                @endcanany
            </tr>
            </thead>

            <tbody>

            @forelse ($blogs as $blog)
                <tr class="row1" data-id="{{ $blog->id }}">
                    <td>{{$loop->iteration}}</td>

                    <td>{{$blog->title}}</td>

                    <td class="d-flex">
                        @can('delete-blog')
                            <x-list.delete route-destroy="{{route('blogs.destroy', $blog->id ) }}"/>
                        @endcan

                        @can('edit-blog')
                            <x-list.edit route-edit="{{route('blogs.edit', $blog->id) }}"/>
                        @endcan

                        <a href="{{route('blogs.show', $blog)}}" class="btn btn-sm btn-default"><i class="mdi mdi-eye text-info font-size-18"></i></a>

                    </td>

                </tr>

            @empty
                <td>No record</td>
            @endforelse

            </tbody>
        </table>
        {!! $blogs->links() !!}

    </div>
</div>

