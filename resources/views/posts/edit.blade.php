@extends('layouts.main')

@section('header')
    <h1>Modifica il post</h1>
@endsection

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titolo" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <label for="subtitle">Sottotitolo</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sottotitolo" value="{{ $post->subtitle }}">
        </div>

        <div class="form-group">
            <label for="text">Testo</label>
            <textarea name="text" class="form-control" id="text" rows="6" placeholder="Corpo del post">{{ $post->text }}</textarea>
        </div>

        <div class="form-group">
            <label for="author">Autore</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Autore" value="{{ $post->author }}">
        </div>

        <div class="form-group">
            <label for="img_path">Immagine</label>
            <input type="text" class="form-control" id="img_path" name="img_path" placeholder="Immagine" value="{{ $post->img_path }}">
        </div>

        <div class="form-group">
            <label for="publication_date">Data di pubblicazione</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" placeholder="Sottotitolo" value="{{ $post->publication_date->format('Y-m-d') }}">
        </div>

        <div class="form-group">
            <label for="post_status">Stato del post</label>
            <select class="custom-select" id="post_status" name="post_status">
              <option value="draft" {{ ($post->infoPost->post_status == 'draft') ? 'selected' : '' }}>draft</option>
              <option value="private" {{ ($post->infoPost->post_status == 'private') ? 'selected' : '' }}>private</option>
              <option value="public" {{ ($post->infoPost->post_status == 'public') ? 'selected' : '' }}>public</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comment_status">Stato Commenti</label>
            <select class="custom-select" id="comment_status" name="comment_status">
              <option value="open" {{ ($post->infoPost->comment_status == 'open') ? 'selected' : '' }}>open</option>
              <option value="closed" {{ ($post->infoPost->comment_status == 'closed') ? 'selected' : '' }}>closed</option>
              <option value="private" {{ ($post->infoPost->comment_status == 'private') ? 'selected' : '' }}>private</option>
            </select>
        </div>

        {{-- 
            @dump($post->tags())
            @dump($post->tags) 
        --}}
        <h3 class="mt-4">Tags</h3>
        @foreach ($tags as $tag)
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="tag-{{ $tag->id }}" name="tags[]" value="{{ $tag->id }}"
                    @if($post->tags->contains($tag->id)) checked @endif    
                    >
                    <label class="custom-control-label" for="tag-{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
            </div>
        @endforeach

        {{-- 
            @dump($post->images)    
            @dump($post->images())     
        --}}

        <h3 class="mt-4">Images</h3>
        @foreach ($images as $image)
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="image-{{ $image->id }}" name="images[]" value="{{ $image->id }}"
                 @if($post->images->contains($image->id)) checked @endif   
                >
                <label class="custom-control-label" for="image-{{ $image->id }}">{{ $image->alt }}
                    <img src="{{ $image->link }}" alt="{{ $image->alt }}" style="width: 50px">
                </label>
            </div>
        </div>
        @endforeach

        <button class="btn btn-success">Salva</button>
        <a href="{{ route('posts.index')}}" class="btn btn-primary float-right">Elenco post</a>
    </form>
@endsection