<a href="{{ route('post.create') }}">Criar Novo Post</a>

<hr>

@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif
<hr>

<h1>Posts</h1>

@foreach ($posts as $post)
    <p>{{ $post->title }} - <a href="{{ route('posts.show') }}">ver post</a></p>
@endforeach