@extends('admin.layouts.app')

@section('title', 'Detalhes do post')

@section('content')
    <h1>Esss é o post {{ $post->title }}</h1>

    <ul>
        <li>
            <strong>Título: </strong>{{ $post->title }}
        </li>

        <li>
            <strong>Conteúdo: </strong>{{ $post->content }}
        </li>
    </ul>

    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Apagar</button>
    </form>
@endsection