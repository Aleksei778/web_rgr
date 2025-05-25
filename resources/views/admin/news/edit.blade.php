@extends('layouts.admin')

@section('title', 'Редактирование новости')

@section('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    <div class="container">
        <h1>Редактирование новости</h1>

        <form action="{{ route('admin.news.update', $news) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Заголовок</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title', $news->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Содержание</label>
                <textarea class="form-control ckeditor @error('content') is-invalid @enderror" 
                          id="content" name="content">{{ old('content', $news->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="button signin-button">Обновить</button>
            <a href="{{ route('admin.news.index') }}" class="button signin-button">Отмена</a>
        </form>
    </div>
@endsection