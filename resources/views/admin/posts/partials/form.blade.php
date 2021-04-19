@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif

@csrf
<input type="text" name="title" id="title" placeholder="título" value="{{ $post->title ?? old('title') }}">
<textarea name="content" id="content" cols="30" rows="10" placeholder="conteúdo">{{ $post->content ?? old('content') }}
</textarea>
<button type="submit">{{ isset($post->title) ? 'salvar edição post' : 'salvar novo post'}}</button>

<hr>

<a href="{{ route('posts.index') }}">Home</a>