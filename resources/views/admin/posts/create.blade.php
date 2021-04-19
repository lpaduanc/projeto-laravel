<h1>Criar Novo Post</h1>

<form action="{{ route('posts.store') }}" method="post">
    @include('admin.posts.partials.form')
</form>