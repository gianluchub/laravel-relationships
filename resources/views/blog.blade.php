@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Il mio blog</h1>
        <div class="row">

            @foreach ($posts as $post)
                <div class="col-4 my-3 d-flex align-content-stretch">
                    <div class="card">
                        <img src="{{ $post->img_path }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <div class="text-left my-3 h5">
                            @foreach ($post->tags as $tag)
                                <span class="badge badge-dark">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                        <a href="{{ route('post', $post->slug) }}" class="btn btn-primary">Leggi</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

@endsection