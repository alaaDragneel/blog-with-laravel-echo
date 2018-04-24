<section class="bar bar-3 bar--sm bg--secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="bar__module">
                    <span class="type--fade">Blogger</span>
                </div>
            </div>
            <div class="col-lg-6 text-right text-left-xs text-left-sm">
                <div class="bar__module">
                    <ul class="menu-horizontal">
                        @if (!auth()->check())
                            @include('frontend.includes.modals')
                        @else
                            <li>
                                <a href="{{ url('/saved-posts') }}">
                                    Saved Posts
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    {{ auth()->user()->name }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/clogout') }}">
                                    Logout
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="#" data-notification-link="search-box">
                                <i class="stack-search"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end of row-->
    </div>
    <!--end of container-->
</section>
