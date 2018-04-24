<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start {{ active_route('admin.index') }}">
                <a href="{{ aurl('/') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            {{-- <li class="heading">
                <h3 class="uppercase">{{ trans('main.users') }}</h3>
            </li> --}}

            @if (userCan('Add Users') || userCan('Edit Users') || userCan('Show Users') || userCan('Delete Users'))
                <li class="nav-item  {{ active_route('users.*') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">{{ trans('main.users') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (userCan('Add Users'))
                            <li class="nav-item {{ active_route('users.create') }}">
                                <a href="{{ route('users.create') }}" class="nav-link ">
                                    <span class="title">{{ trans('main.add') }} {{ trans('main.user') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (userCan('Show Users'))
                            <li class="nav-item {{ active_route('users.index') }}">
                                <a href="{{ route('users.index') }}" class="nav-link ">
                                    <span class="title">{{ trans('main.show-all') }} {{ trans('main.users') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (userCan('Add Roles') || userCan('Edit Roles') || userCan('Show Roles') || userCan('Delete Roles'))
                <li class="nav-item  {{ active_route('roles.*') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-get-pocket"></i>
                        <span class="title">{{ trans('main.roles') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (userCan('Add Roles'))
                            <li class="nav-item {{ active_route('roles.create') }}">
                                <a href="{{ route('roles.create') }}" class="nav-link ">
                                    <span class="title">{{ trans('main.add') }} {{ trans('main.role') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (userCan('Show Roles'))
                            <li class="nav-item {{ active_route('roles.index') }}">
                                <a href="{{ route('roles.index') }}" class="nav-link ">
                                    <span class="title">{{ trans('main.show-all') }} {{ trans('main.roles') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (userCan('Add Tags') || userCan('Edit Tags') || userCan('Show Tags') || userCan('Delete Tags'))
                <li class="nav-item  {{ active_route('tags.*') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-tag"></i>
                        <span class="title">{{ trans('main.tags') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (userCan('Add Tags'))
                            <li class="nav-item {{ active_route('tags.create') }}">
                                <a href="{{ route('tags.create') }}" class="nav-link ">
                                    <span class="title">{{ trans('main.add') }} {{ trans('main.tag') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (userCan('Show Tags'))
                            <li class="nav-item {{ active_route('tags.index') }}">
                                <a href="{{ route('tags.index') }}" class="nav-link ">
                                    <span class="title">{{ trans('main.show-all') }} {{ trans('main.tags') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if (userCan('Add Posts') || userCan('Edit Posts') || userCan('Show Posts') || userCan('Delete Posts'))
                <li class="nav-item  {{ active_route('posts.*') }}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="fa fa-clipboard"></i>
                        <span class="title">{{ trans('main.posts') }}</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        @if (userCan('Add Posts'))
                            <li class="nav-item {{ active_route('posts.create') }}">
                                <a href="{{ route('posts.create') }}" class="nav-link ">
                                    <span class="title">{{ trans('main.add') }} {{ trans('main.post') }}</span>
                                </a>
                            </li>
                        @endif
                        @if (userCan('Show Posts'))
                            <li class="nav-item {{ active_route('posts.index') }}">
                                <a href="{{ route('posts.index') }}" class="nav-link ">
                                    <span class="title">{{ trans('main.show-all') }} {{ trans('main.posts') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
