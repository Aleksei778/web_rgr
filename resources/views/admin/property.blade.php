@extends('layouts.admin')

@section('title', 'Заявки')

@section('content')
    <section class='section-single'>
        <h1 data-ru="Последние новости из мира недвижимости"
            data-en="Latest news from the real estate world">
            Редактирование новостей
        </h1>
        <p data-ru="Последний раз обновлено: Февраль, 2025"
                data-en="Last Time Updated: February, 2025"
        >Последний раз обновлено: {{ $news->last()->created_at->format('d.m.Y H:i') }}</p>
    </section>

    <section class='privacy-card'>
        @foreach($news as $item)
            <div class="news-item">
                <h2 class="section-title">{!! $item->title !!}</h2>
                <p>{!! $item->content !!}</p>
                <small>Опубликовано: {{ $item->created_at->format('d.m.Y H:i') }}</small>
                <small>Изменено: {{ $item->updated_at->format('d.m.Y H:i') }}</small>
                <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning">Редактировать</a>
                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button signin-button" onclick="return confirm('Вы уверены?')">Удалить</button>
                </form>
            </div>
            <hr>
        @endforeach
    </section>
@endsection
