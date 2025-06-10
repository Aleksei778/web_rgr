@extends('layouts.admin')

@section('title', 'Новости')

@section('content')
    <section class='section-single'>
        <h1 data-ru="Последние новости из мира недвижимости"
            data-en="Latest news from the real estate world">
            Редактирование новостей
        </h1>
        @if ($news->isNotEmpty())
            <p data-ru="Последний раз обновлено: Февраль, 2025"
                    data-en="Last Time Updated: February, 2025"
            >Последний раз обновлено: {{ $news->last()->updated_at->format('d.m.Y H:i') }}</p>
        @else
            <p>Последний раз обновлено: -</p>
        @endif
        <a style="margin-top: 35px;" class="button startforfree" href="{{ route('admin.news.create') }}">Добавить новость</a>
    </section>

    <section class='privacy-card'>
        @if ($news->isNotEmpty())
            @foreach($news as $item)
                <div class="news-item">
                    <h2 class="section-title">{!! $item->title !!}</h2>
                    <p>{!! $item->content !!}</p>
                    <small>Опубликовано: <strong>{{ $item->created_at->format('d.m.Y H:i') }}</strong></small>
                    <small>Изменено: <strong>{{ $item->updated_at->format('d.m.Y H:i') }}</strong></small>
                    <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning" style="margin-left: 20px;">Редактировать</a>
                    <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button signin-button" style="margin-bottom: 20px; margin-top: 20px;" onclick="return confirm('Вы уверены?')">Удалить</button>
                    </form>
                </div>
                <hr>
            @endforeach
        @else
            <p>Новостей пока нет</p>
        @endif
    </section>
@endsection
