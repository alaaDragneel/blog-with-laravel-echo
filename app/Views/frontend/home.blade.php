@extends('frontend.layouts.app')


@section('content')
    <section class="space--sm">
        <div class="container">
            <div class="d-flex align-items-center">
                <h3>{!! $title !!}</h3>
            </div>
            <hr>
            <posts-component :posts="{{ json_encode($posts) }}"></posts-component>
        </div>
    </section>
@endsection
