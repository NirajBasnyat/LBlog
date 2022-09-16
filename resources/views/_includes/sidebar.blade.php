<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <x-sidebar-item route="{{route('home')}}" name="Dashboard">
                    <i class="bx bx-home-circle"></i>
                </x-sidebar-item>

                @can('access-site-setting-page')
                    <x-sidebar-item route="{{route('admin.site-settings.edit', (new App\Models\Admin\SiteSetting)->first())}}" name="Site Settings">
                        <i class="bx bx-wrench"></i>
                    </x-sidebar-item>
                @endcan

                @can('access-role-page')
                    <x-sidebar-item route="{{route('admin.roles.index')}}" name="Roles">
                        <i class="bx bxs-group"></i>
                    </x-sidebar-item>
                @endcan

                @can('access-permission-page')
                    <x-sidebar-item route="{{route('admin.permissions.index')}}" name="Permissions">
                        <i class="bx bx-shield"></i>
                    </x-sidebar-item>
                @endcan

                @can('access-user-page')
                    <x-sidebar-item route="{{route('admin.users.index')}}" name="Users">
                        <i class="bx bx-user-plus"></i>
                    </x-sidebar-item>
                @endcan

                @can('access-category-page')
                    <x-sidebar-item route="{{route('admin.categories.index')}}" name="Categories">
                        <i class="bx bx-grid-alt"></i>
                    </x-sidebar-item>
                @endcan

                @can('access-blog-page')
                    <x-sidebar-item route="{{route('blogs.index')}}" name="Blogs">
                        <i class="bx bx-text"></i>
                    </x-sidebar-item>
                @endcan

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>