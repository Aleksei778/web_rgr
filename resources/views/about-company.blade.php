@extends('layouts.app')

@section('title', 'Новости')

@section('content')
    <section class='section-single'>
        <h1 data-ru="Последние новости из мира недвижимости"
            data-en="Latest news from the real estate world">
            {{ __('about.title') }}<br>
            {{ __('about.list') }}
        </h1>
    </section>

    {{-- История компании --}}
    <section class='privacy-card' id="history">
        <div class="news-item">
            <h2 class="section-title">{{ __('about.history') }}</h2>
            <ul>
                @foreach($histories as $history)
                    <li>
                        <strong>{{ $history->title }}:</strong> {{ $history->content }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Услуги --}}
    <section class='privacy-card' id="services">
        <div class="news-item">
            <h2 class="section-title">{{ __('about.service') }}</h2>
            <div class="services-container">
                <div class="services-column">
                    <ol class="services-list">
                        @foreach($services->take(2) as $service)
                            <li>
                                <strong>{{ $service->title }}:</strong>
                                <div>{!! nl2br(e($service->content)) !!}</div>
                            </li>
                        @endforeach
                    </ol>
                </div>
                <div class="services-column">
                    <ol class="services-list" start="3">
                        @foreach($services->skip(2) as $service)
                            <li>
                                <strong>{{ $service->title }}:</strong>
                                <div>{!! nl2br(e($service->content)) !!}</div>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- Награды --}}
    <section class='privacy-card' id="awards">
        <div class="news-item">
            <h2 class="section-title">{{ __('about.awards') }}</h2>
            <ul>
                @foreach($awards as $award)
                    <li><strong>{{ $award->content }}</strong></li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection