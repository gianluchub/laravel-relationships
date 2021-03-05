@extends('layouts.main')
<style type="text/css">
    #img-col {
        max-width: 150px;
    }
    
    table img {
        width: 100%;
    }
</style>
@section('head')
    
@endsection

@section('header')
    <h1>Elenco Post</h1>
@endsection

@section('content')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>Sottotitolo</th>
                {{-- <th>Testo</th> --}}
                <th>Autore</th>
                <th id="img-col">Immagine</th>
                <th>Data pubblicazione</th>
                <th>Data creazione</th>
                <th>Data ultima modifica</th>
                <th>Status</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->subtitle }}</td>
                    {{-- <td>{{ substr($item->subtitle, 0, 10) }}</td> --}}
                    <td>{{ $item->author }}</td>
                    <td><img src="{{ $item->img_path }}" alt=""></td>
                    <td>{{ $item->publication_date }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>{{ $item->infoPost->post_status }}</td>
                    <td class="text-center">
                        <a href="{{ route('posts.show', $item->id) }}" class="btn btn-success"><i class="fas fa-search"></i></a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('posts.destroy', $item->id) }}" method="POST" onSubmit="return confirm('Sei sicuro di voler eliminare questo post?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@section('footer')
    <div class="text-right">
        <a href="{{ route('posts.create')}}" class="btn btn-primary">Scrivi un nuovo post</a>
    </div>
@endsection