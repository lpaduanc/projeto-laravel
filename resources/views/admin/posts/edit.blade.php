@extends('admin.layouts.app')

@section('title', 'Editando um post')

@section('content')
    <h1>editar o Post <strong>{{ $post->title }}</strong></h1>

    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.posts.partials.form')
    </form>
@endsection