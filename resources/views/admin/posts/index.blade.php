@extends('admin.layouts.app')

@section('title', 'Listagem de posts')

@section('content')

    <a href="{{ route('posts.create') }}">Criar Novo Post</a>

    <hr>

    @if (session('message'))
        <div>
            {{ session('message') }}
        </div>
        <hr>
    @endif

    <form action="{{ route('posts.search') }}" method="post">
        @csrf
        <input type="text" name="search" id="search" placeholder="pesquisar">
        <button type="submit">pesquisar</button>
    </form>

    <h1>Posts</h1>

    @foreach ($posts as $post)
        <p>
            <img
                src="{{ url("storage/{$post->image}") }}"
                alt="{{ $post->title }}"
                style="max-width:100px;"
            >
            {{ $post->title }} -
            <a href="{{ route('posts.show', $post->id) }}">
                ver post
            </a>
                --
            <a href="{{ route('posts.edit', $post->id) }}">
                editar post
            </a>
        </p>
    @endforeach

    <hr>

    {{-- paginação --}}
    @if (isset($filters))
        {{ $posts->appends($filters)->links() }}
        
    @else
        {{ $posts->links() }}   
    @endif

    
@endsection