@extends('layouts.app')

@section('title', 'Новости')

@section('content')
    <section class='section-single'>
        <h1 data-ru="Последние новости из мира недвижимости"
            data-en="Latest news from the real estate world">
            {{ __('news.last_news') }}
        </h1>
        @if ($news->isNotEmpty())
            <p data-ru="Последний раз обновлено: Февраль, 2025"
                    data-en="Last Time Updated: February, 2025"
            >{{ __('news.last_update') }}: {{ $news->last()->updated_at->format('d.m.Y H:i') }}</p>
        @else
            <p>{{ __('news.last_update') }}: -</p>
        @endif
    </section>

    <section class='privacy-card'>
        @if ($news->isNotEmpty())
            @foreach($news as $item)
                <div class="news-item">
                    <h2 class="section-title">{!! $item->title !!}</h2>
                    <p>{!! $item->content !!}</p>
                    <small>{{ __('news.pub') }}: <strong>{{ $item->created_at->format('d.m.Y H:i') }}</strong></small>
                    <small>{{ __('news.updated') }}: <strong>{{ $item->updated_at->format('d.m.Y H:i') }}</strong></small>
                </div>
                <hr>
            @endforeach
        @else
            <p>{{ __('news.no_news') }}</p>
        @endif
    </section>
@endsection
