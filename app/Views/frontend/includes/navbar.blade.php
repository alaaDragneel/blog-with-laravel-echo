<div class="nav-container ">
    <div class="bar bar--sm visible-xs">
        <div class="container">
            <div class="row">
                <div class="col-3 col-md-2">
                    <a href="{{ url('/') }}">
                        <h3>Blogger</h3>
                    </a>
                </div>
                <div class="col-9 col-md-10 text-right">
                    <a href="#" class="hamburger-toggle" data-toggle-class="#menu1;hidden-xs">
                        <i class="icon icon--sm stack-interface stack-menu"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>

    <nav id="menu1" class="bar bar--sm bar-1 hidden-xs ">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-md-2 hidden-xs">
                    <div class="bar__module">
                        <a href="{{ url('/') }}">
                            <h3>Blogger</h3>
                        </a>
                    </div>

                </div>
                <div class="col-lg-11 col-md-12 text-right text-left-xs text-left-sm">
                    <div class="bar__module">
                        <ul class="menu-horizontal text-left">
                            <li>
                                <a href="{{ url('/') }}"> <span> Home </span></a>
                            </li>
                            @foreach ($tags as $tag)
                                <li>
                                    <a href="{{ url('/tags/' . $tag->id . '/' . str_slug($tag->name)) }}"> <span> {{ $tag->name }} </span></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

        </div>

    </nav>

</div>
