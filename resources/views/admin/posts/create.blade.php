@extends('admin.layouts.app')

@section('title', 'Criando novo post')

@section('content')
    <h1>Criar Novo Post</h1>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @include('admin.posts.partials.form')
    </form>
@endsection