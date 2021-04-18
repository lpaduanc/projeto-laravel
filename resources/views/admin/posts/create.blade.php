<h1>Criar Novo Post</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif

<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <input type="text" name="title" id="title" placeholder="título" value="{{ old('title') }}">
    <textarea name="content" id="content" cols="30" rows="10" placeholder="conteúdo">{{ old('content') }}</textarea>
    <button type="submit">criar post</button>
</form>