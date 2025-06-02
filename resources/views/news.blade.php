@extends('layouts.app')

@section('title', 'Новости')

@section('content')
    <section class='section-single'>
        <h1 data-ru="Последние новости из мира недвижимости"
            data-en="Latest news from the real estate world">
            Последние новости из мира недвижимости
        </h1>
        <p data-ru="Последний раз обновлено: Февраль, 2025"
                data-en="Last Time Updated: February, 2025"
        >Последний раз обновлено: {{ $news->last()->updated_at->format('d.m.Y H:i') }}</p>
    </section>

    <section class='privacy-card'>
        @foreach($news as $item)
            <div class="news-item">
                <h2 class="section-title">{!! $item->title !!}</h2>
                <p>{!! $item->content !!}</p>
                <small>Опубликовано: <strong>{{ $item->created_at->format('d.m.Y H:i') }}</strong></small>
                <small>Изменено: <strong>{{ $item->updated_at->format('d.m.Y H:i') }}</strong></small>
            </div>
            <hr>
        @endforeach
    </section>
@endsection
