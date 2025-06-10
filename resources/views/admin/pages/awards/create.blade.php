@extends('layouts.admin')

@section('title', 'Добавление истории')

@section('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    <div class="container">
        <h1>Добавление истории</h1>

        <form action="{{ route('admin.pages.history.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="title_ru" class="form-label">Заголовок (RU)</label>
                <input type="text" class="form-control @error('title_ru') is-invalid @enderror" 
                       id="title_ru" name="title_ru" value="{{ old('title_ru') }}">
                @error('title_ru')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content_ru" class="form-label">Содержание (RU)</label>
                <textarea class="form-control ckeditor @error('content_ru') is-invalid @enderror" 
                          id="content_ru" name="content_ru">{{ old('content_ru') }}</textarea>
                @error('content_ru')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title_en" class="form-label">Заголовок (EN)</label>
                <input type="text" class="form-control @error('title_en') is-invalid @enderror" 
                       id="title_ru" name="title_en" value="{{ old('title_en') }}">
                @error('title_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content_en" class="form-label">Содержание (EN)</label>
                <textarea class="form-control ckeditor @error('content_rn') is-invalid @enderror" 
                          id="content_en" name="content_en">{{ old('content_en') }}</textarea>
                @error('content_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="button signin-button">Сохранить</button>
            <a href="{{ route('admin.pages.index') }}" class="button logout-button">Отмена</a>
        </form>
    </div>
@endsection