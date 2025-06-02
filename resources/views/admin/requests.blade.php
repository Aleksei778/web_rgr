@extends('layouts.admin')

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
                            @if($r->status === 'sended')
                                <button type="button"
                                class="accept-btn"
                                onclick="acceptRequest({{ $r->id }})">Одобрить</button>

                                <button type="button"
                                class="reject-btn"
                                onclick="rejectRequest({{ $r->id }})">Отклонить</button>
                            @elseif($r->status === 'accepted')
                            <span class="status-badge accepted">✅ Одобрена</span>
                            @elseif($r->status === 'rejected')
                            <span class="status-badge rejected">❌ Отклонена</span>
                            @endif
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

@section('scripts')
<script>
// -- Функции для модального окна --
async function openRequestModal(requestId, action) {

    console.log('openRequestModal');
    const spec_window = document.getElementById("spec_window");
    if (spec_window) {
        return;
    }

    const overlay = document.createElement("div");
    overlay.style.cssText = `
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 99999999999999;
        background-color: rgba(0, 0, 0, 0.5);
        display: grid;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(3px);
    `;
    overlay.id = "spec_window";
    overlay.classList.add("spec_window");

    const spec_window_container = document.createElement("div");
    spec_window_container.style.cssText = `
        max-width: 500px;
        width: 90%;
        padding: 40px;
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        text-align: center;
        animation: slideDown 0.3s ease-out;
    `;
    
    // Добавляем анимацию
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
    
    spec_window_container.id = "spec_window_container";
    spec_window_container.classList.add("spec_window_container");
    
    const h3 = document.createElement("h3");
    h3.textContent = action === 'approve' ? 'Одобрить заявку' : 'Отклонить заявку';
    h3.style.cssText = `
        font-size: 24px;
        color: #333;
        margin-bottom: 30px;
        font-weight: 500;
    `;

    const form = document.createElement("form");
    form.style.cssText = `
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 100%;
        text-align: left;
    `;

    // Создаем поле для сообщения
    const messageLabel = document.createElement("label");
    messageLabel.textContent = action === 'approve' ? 'Сообщение для пользователя (опционально):' : 'Причина отклонения:';
    messageLabel.style.cssText = `
        font-size: 16px;
        color: #333;
        font-weight: 500;
        margin-bottom: 5px;
    `;

    const messageTextarea = document.createElement("textarea");
    messageTextarea.name = "message";
    messageTextarea.id = "messageTextarea";
    messageTextarea.placeholder = action === 'approve' 
        ? 'Введите сообщение для пользователя...' 
        : 'Укажите причину отклонения заявки...';
    messageTextarea.rows = 4;
    messageTextarea.style.cssText = `
        padding: 12px 15px;
        border: 2px solid #e1e1e1;
        border-radius: 8px;
        font-size: 14px;
        color: #333;
        background-color: #f8f9fa;
        outline: none;
        transition: all 0.3s ease;
        width: 100%;
        resize: vertical;
        font-family: inherit;
    `;

    if (action === 'reject') {
        messageTextarea.required = true;
    }
    
    messageTextarea.onfocus = () => messageTextarea.style.borderColor = '#007bff';
    messageTextarea.onblur = () => messageTextarea.style.borderColor = '#e1e1e1';

    // Контейнер для кнопок
    const buttonContainer = document.createElement("div");
    buttonContainer.style.cssText = `
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 20px;
    `;

    const cancelButton = document.createElement("button");
    cancelButton.type = "button";
    cancelButton.textContent = "Отмена";
    cancelButton.style.cssText = `
        padding: 12px 25px;
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    `;
    
    cancelButton.onmouseover = () => {
        cancelButton.style.backgroundColor = '#545b62';
        cancelButton.style.transform = 'translateY(-2px)';
    };
    cancelButton.onmouseout = () => {
        cancelButton.style.backgroundColor = '#6c757d';
        cancelButton.style.transform = 'translateY(0)';
    };

    const submitButton = document.createElement("button");
    submitButton.type = "submit";
    submitButton.textContent = action === 'approve' ? 'Одобрить' : 'Отклонить';
    const buttonColor = action === 'approve' ? '#28a745' : '#dc3545';
    const buttonHoverColor = action === 'approve' ? '#218838' : '#c82333';
    
    submitButton.style.cssText = `
        padding: 12px 25px;
        background-color: ${buttonColor};
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    `;
    
    submitButton.onmouseover = () => {
        submitButton.style.backgroundColor = buttonHoverColor;
        submitButton.style.transform = 'translateY(-2px)';
    };
    submitButton.onmouseout = () => {
        submitButton.style.backgroundColor = buttonColor;
        submitButton.style.transform = 'translateY(0)';
    };

    buttonContainer.appendChild(cancelButton);
    buttonContainer.appendChild(submitButton);

    // Собираем форму
    form.appendChild(messageLabel);
    form.appendChild(messageTextarea);
    form.appendChild(buttonContainer);
    
    spec_window_container.appendChild(h3);
    spec_window_container.appendChild(form);

    overlay.appendChild(spec_window_container);
    document.body.appendChild(overlay);

    // Обработчик отправки формы
    form.addEventListener('submit', async (e) => {
        // e.preventDefault();

        console.log('sub');
        
        const message = messageTextarea.value.trim();
        
        // Проверяем обязательность поля для отклонения
        if (action === 'reject' && !message) {
            alert('Пожалуйста, укажите причину отклонения');
            return;
        }

        try {
            console.log('hiiii');
            await handleRequestAction(requestId, action, message);
            overlay.remove();
            style.remove();
        } catch (error) {
            console.error('Ошибка при обработке заявки:', error);
            alert('Произошла ошибка при обработке заявки');
        }
    });

    // Обработчик кнопки отмены
    cancelButton.addEventListener('click', () => {
        overlay.remove();
        style.remove();
    });

    // Закрытие по клику на overlay
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            overlay.remove();
            style.remove();
        }
    });
}

// Функция для обработки действия с заявкой
async function handleRequestAction(requestId, action, message) {
    console.log("handleRequestAction");
    const url = action === 'approve' 
        ? `/admin/property-requests/${requestId}/accept`
        : `/admin/property-requests/${requestId}/reject`;
    
    const formData = new FormData();
    console.log("no problems1");
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    if (message) {
        const fieldName = action === 'approve' ? 'approval_message' : 'rejection_reason';
        formData.append(fieldName, message);
    }
    console.log("no problems2");
    const response = await fetch(url, {
        method: 'POST',
        body: formData
    });

    if (response.ok) {
        // Перезагружаем страницу или обновляем UI
        window.location.reload();
    } else {
        console.log('Some problems');
        throw new Error('Ошибка сервера');
    }
}

// Функции для вызова модального окна
function acceptRequest(requestId) {
    console.log("acceptRequest");
    openRequestModal(requestId, 'approve');
}

function rejectRequest(requestId) {
    console.log("rejectRequest");
    openRequestModal(requestId, 'reject');
}
</script>
@endsection