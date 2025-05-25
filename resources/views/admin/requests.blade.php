@extends('layouts.app')

@section('title', 'Список заявок')

@section('content')
    <section class="contactform-section">
        <h2>
            Заявки
        </h2>
        <table class="req_table">
            <thead>
                <th><a href="{{ route('admin.property.requests', ['sort_by' => 'property_requests.id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">ID заявки</a></th>
                <th><a href="{{ route('admin.property.requests', ['sort_by' => 'users.id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">ID пользователя</a></th>
                <th><a href="{{ route('admin.property.requests', ['sort_by' => 'users.last_name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">ФИО пользователя</a></th>
                <th><a href="{{ route('admin.property.requests', ['sort_by' => 'property_requests.message', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">Сообщение</a></th>
                <th><a href="{{ route('admin.property.requests', ['sort_by' => 'properties.id', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">ID недвижимости</a></th>
                <th><a href="{{ route('admin.property.requests', ['sort_by' => 'properties.address', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">Адрес недвижимости</a></th>
                <th><a href="{{ route('admin.property.requests', ['sort_by' => 'property_requests.created_at', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">Дата создания</a></th>
                <th>Действия по заявке</th>
            </thead>
            <tbody>
                @foreach ($propRequests as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>{{ $r->user->id }}</td>
                        <td>{{ $r->user->last_name . " " . $r->user->first_name . " " . $r->user->middle_name }}</td>
                        <td>{{ $r->message }}</td>
                        <td>{{ $r->property->id }}</td>
                        <td>{{ $r->property->address }}</td>
                        <td>{{ $r->created_at->format('d.m.Y H:i') }}
                        </td>
                        <td>
                            <a href="" class="accept-btn">Одобрить</a>
                            <a href="" class="reject-btn">Отклонить</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $propRequests->appends(['sort_by' => $sortBy, 'order' => $order])->links('pagination::bootstrap-4') }}
        </div>
    </section>
@endsection