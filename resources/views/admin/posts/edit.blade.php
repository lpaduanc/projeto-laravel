<h1>editar o Post <strong>{{ $post->title }}</strong></h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="post">
    @csrf
    @method('PUT')
    <input type="text" name="title" id="title" placeholder="título" value="{{ $post->title }}">
    <textarea name="content" id="content" cols="30" rows="10" placeholder="conteúdo">{{ $post->content }}</textarea>
    <button type="submit">editar post</button>
</form>