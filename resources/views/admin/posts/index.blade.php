<a href="{{ route('posts.create') }}">Criar Novo Post</a>

<hr>

@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
    <hr>
@endif

<h1>Posts</h1>

@foreach ($posts as $post)
    <p>{{ $post->title }} -
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
{{ $posts->links() }}