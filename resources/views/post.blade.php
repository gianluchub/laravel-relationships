@extends('layouts.main')

@section('content')
   
    <section id="article">
        <header class="text-center mb-4">
            <img src="{{ $post->img_path }}" alt="{{ $post->title }}">
            <h1 class="mt-4">{{ $post->title }}</h1>
            <h3>{{ $post->subtitle }}</h3>
            <small>{{ $post->author }} - {{ $post->publication_date->format('d-m-Y') }} - {{ $post->infoPost->post_status }} - {{ $post->infoPost->comment_status }}</small>
            {{--  TAGS --}}
            <div class="text-center h4 mt-3">
                @foreach ($post->tags as $tag)
                    <span class="badge badge-dark">{{ $tag->name }}</span>
                @endforeach
            </div>
            {{--  /TAGS --}}
        </header>
        <main>
            {{ $post->text }}

            <div class="container my-4">
                <div class="row justify-content-center">
                    @foreach ($post->images as $image)
                        <div class="col-4">
                            <figure>
                                <img src="{{ $image->link }}" alt="{{ $image->alt }}" class="img-fluid">
                                <figcaption>{{ $image->caption }}</figcaption>
                            </figure>
                        </div>
                    @endforeach     
                </div>
            </div>
        </main>
    </section>

    @if($post->infoPost->comment_status == 'open')
        <section id="comments" class="my-4">
            <h2>Commenti</h2>
            @foreach ($post->comments as $comment)
                <div>
                    <small>{{ $comment->author }} - {{ $comment->created_at->diffForHumans() }}</small>
                    <p>{{ $comment->text }}</p>
                </div>
            @endforeach
        </section>

        <section id="form">
            <form action="{{ route('add-comment', $post->id) }}" method="POST">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="author">Autore</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="Scrivi qui il tuo nickname" value="">
                </div>
                <div class="form-group">
                    <label for="text">Testo</label>
                    <textarea name="text" class="form-control" id="text" rows="6" placeholder="Scrivi qui il tuo commento"></textarea>
                </div>
                <input type="submit" value="Invia" class="btn btn-secondary">
            </form>
        </section>
    @endif

    @section('footer')
        <a class="btn btn-primary" href="{{ route('blog') }}">Torna al Blog</a>
    @endsection

@endsection