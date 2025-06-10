@extends('layouts.admin')

@section('title', 'Управление разделами')

@section('content')

<section class='section-single'>
<h1 data-ru="Последние новости из мира недвижимости"
    data-en="Latest news from the real estate world">
    {{ __('admin_pages.title') }}
</h1>
</section>

<!-- История компании -->
<section class='privacy-card'>
    <div class="news-item">
        <h2>{{ __('admin_pages.history') }}</h2>
        <a href="{{ route('admin.pages.history.create') }}" class="button signin-button" style="margin-bottom: 50px;">{{ __('admin_pages.add_history') }}</a>
    </div>
    
    @if($histories->count() > 0)
        <div class="table-responsive">
            <table class="req_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Описание</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>{{ $history->id }}</td>
                            <td>{{ $history->title }}</td>
                            <td>{{ $history->content }}</td>
                            <td>
                                <a href="{{ route('admin.pages.history.edit', $history->id) }}" class="accept-btn">{{ __('admin_pages.edit') }}</a>
                                <form method="POST" action="{{ route('admin.pages.history.delete', $history->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="reject-btn" onclick="return confirm('Вы уверены?')">{{ __('admin_pages.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>{{ __('admin_pages.no_history') }}</p>
    @endif
</section>

<!-- Услуги компании -->
<section class='privacy-card'>
    <div class="news-item">
        <h2>{{ __('admin_pages.services') }}</h2>
        <a href="{{ route('admin.pages.service.create') }}" class="button signin-button" style="margin-bottom: 50px;">{{ __('admin_pages.add_services') }}</a>
    </div>
    
    @if($services->count() > 0)
        <div class="table-responsive">
            <table class="req_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('admin_pages.title_table') }}</th>
                        <th>{{ __('admin_pages.description_table') }}</th>
                        <th>{{ __('admin_pages.action_table') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->title }}</td>
                            <td>{{ $service->content }}</td>
                            <td>
                                <a href="{{ route('admin.pages.service.edit', $service->id) }}" class="accept-btn">{{ __('admin_pages.edit') }}</a>
                                <form method="POST" action="{{ route('admin.pages.service.delete', $service->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="reject-btn" onclick="return confirm('Вы уверены?')">{{ __('admin_pages.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>{{ __('admin_pages.no_services') }}</p>
    @endif
</section>

<!-- Награды компании -->
<section class='privacy-card'>
    <div class="news-item">
        <h2>{{ __('admin_pages.awards') }}</h2>
        <a href="{{ route('admin.pages.award.create') }}" class="button signin-button" style="margin-bottom: 50px;">{{ __('admin_pages.add_awards') }}</a>
    </div>
    
    @if($awards->count() > 0)
        <div class="table-responsive">
            <table class="req_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Заголовок</th>
                        <th>Описание</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($awards as $award)
                        <tr>
                            <td>{{ $award->id }}</td>
                            <td>{{ $award->title }}</td>
                            <td>{{ $award->content }}</td>
                            <td>
                                <a href="{{ route('admin.pages.award.edit', $award->id) }}" class="accept-btn">{{ __('admin_pages.edit') }}</a>
                                <form method="POST" action="{{ route('admin.pages.award.delete', $award->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="reject-btn" onclick="return confirm('Вы уверены?')">{{ __('admin_pages.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>{{ __('admin_pages.no_awards') }}</p>
    @endif
</section>
@endsection