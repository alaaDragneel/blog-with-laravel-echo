@extends('frontend.layouts.app')


@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <article>
                        <div class="article__title text-center">
                            <h1 class="h2">{{ $post->title }}</h1>
                            <span>{{ $post->created_at }} in </span>
                            <span>
                                @foreach ($post->tags as $tag)
                                    <a href="{{ url('/tags/' . $tag->id . '/' . str_slug($tag->name)) }}">{{ $tag->name }}</a>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </span>
                        </div>
                        <!--end article title-->
                        <div class="article__body">
                            <img style="width: 100%;" alt="Image" src="{{ ShowImage($post->image) }}" />
                            {!! $post->body !!}
                        </div>
                        <div class="article__share text-center">
                            <p>Did You Like The Post Share It :)</p>
                            {!! Share::currentPage()->facebook()->twitter()->googlePlus()->linkedin() !!}
                            @if (auth()->check())
                                <br>
                                <p>Or Save, Like It To View Later</p>
                                <span style="margin-right: 72px;">
                                    <a style="text-decoration: none; {{ in_array($post->id, auth()->user()->saved_posts->pluck('id')->toArray()) ? 'color: #f95045;' : 'color: #555;' }}" href="{{ url('/save-post/' . $post->id) }}">
                                        <i class="fa fa-heart fa-3x"></i>
                                    </a>
                                </span>
                                <span>
                                    <a style="text-decoration: none; {{ in_array($post->id, auth()->user()->likes->pluck('post_id')->toArray()) ? 'color: rgb(28, 159, 214);' : 'color: #555;' }}" href="{{ url('/like-post/' . $post->id) }}">
                                        <i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i>
                                    </a>
                                </span>
                            @endif
                        </div>
                    </article>
                    <!--end item-->
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>
    @if (auth()->check())
        <comments-section :post_id="{{ $post->id }}" :comments="{{ json_encode($post->comments) }}"></comments-section>
    @endif
@endsection
