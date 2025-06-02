@extends('layouts.app')

@section('title', 'Профиль')

@section('content')
    <section id="profile" class="profile-section">
        <div class="profile-header">
            <div class="profile-info-container">
                <i class="fas fa-user-circle profile-icon"></i>
                <div class="profile-info">
                    <h2 id="user-name">{{ $user->last_name . " " . $user->first_name . " " . $user->middle_name }}</h2>
                    <p id="user-email"><strong>Email:</strong> {{ $user->email }}</p>
                    <a href="{{ route('profile') }}" class="resetpass-btn">Забыли пароль?</a>
                </div>
            </div>
            <div class="stat-box subscription-end">
                <div class="stat-value" id="subscription-end">{{ $user->email_verified_at->format('d.m.Y H:i:s') }}</div>
                <div class="stat-label">Email Verified At</div>
            </div>
            <div class="stat-box subscription-end">
                <div class="stat-value" id="subscription-end">{{ $user->created_at->format('d.m.Y H:i:s') }}</div>
                <div class="stat-label">Registered At</div>
            </div>
            
        </div>
    </section>

    <section id="campaign-management" class="campaign-section">
        <h3>Менеджемент заявок</h3>
        <div class="campaign-list-container">
            @if ($requests->count() > 0)
                <ul class="campaign-list" id="campaign-list">
                    @foreach ($requests as $req)
                        <li class="campaign-item">
                            <div class="campaign-info">
                                <h5>{{ $req->title }}</h5>
                                <p class="campaign-date">Была отправлена: <strong>{{ $req->created_at->format('d.m.Y') }}</strong></p>
                                <p class="campaign-status">
                                    @if ($req->status === 'sended')
                                        <span class="status-badge sended"><strong>⏲️ Рассматривается</strong></span>
                                    @elseif($req->status === 'accepted')
                                        <span class="status-badge accepted"><strong>✅ Одобрена</strong></span>
                                    @elseif($req->status === 'rejected')
                                        <span class="status-badge rejected"><strong>❌ Отклонена</strong></span>
                                    @endif
                                </p>
                                <div class="campaign-message">
                                    <p>Ваше сообщение: <strong>{{ $req->message }}</strong></p>
                                </div>
                            </div>
                        </li>
                    @endforeach

                
                    <div class="pagination-container">
                        {{ $requests->links('pagination::bootstrap-4') }}
                    </div>
                </ul>
            @else
                <h1 class="no-reqs">У вас пока нет заявок.</h1>
            @endif
        </div>
    </section>

    <section id="contact" class="contact-us-section" role="article">
        <div class="section-container">
            <h2>Отмена заявок!</h2>
            <div class="contact-content">
                <i class="fas fa-envelope-open-text fa-3x"></i>
                <p class="highlight">{{ $adminEmail }}</p>
                <p>
                    Пишите на почту администратору при желании отменить свои заявки
                </p>
            </div>
            <div class="video-container">
                <video src="{{ asset('video/5.webm') }}" class="animation" autoplay muted loop loading="lazy" preload="none"></video>
            </div>
        </div>
    </section>
@endsection