<?php

namespace App\Notifications;

use App\Models\PropertyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class NewPropertyRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;
    
    protected $propRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct(PropertyRequest $prop_request)
    {
        $this->propRequest = $prop_request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        try {
            // Проверяем, что propRequest существует
            if (!$this->propRequest) {
                throw new \Exception('PropertyRequest not found');
            }

            // Получаем связанные модели с проверкой на существование
            $property = $this->propRequest->property;
            $user = $this->propRequest->user;

            if (!$property) {
                throw new \Exception('Property not found for request ID: ' . $this->propRequest->id);
            }

            if (!$user) {
                throw new \Exception('User not found for request ID: ' . $this->propRequest->id);
            }

            if (view()->exists('property.email')) {
                
                $url = url('/admin/property-requests/');
                return (new MailMessage)
                    ->subject('Новая заявка на квартиру: ' . $property->address)
                    ->view('property.email', [
                        'url' => $url, 
                        'user' => $notifiable,
                        'property' => $property,
                        'propRequest' => $this->propRequest,
                        'requestUser' => $user
                    ]);
            } else {
                // Используем стандартный шаблон, если кастомный не найден
                $mailMessage = (new MailMessage)
                    ->subject('Новая заявка на квартиру: ' . ($property->address ?? 'Адрес не указан'))
                    ->greeting('Здравствуйте!')
                    ->line('Получена новая заявка на квартиру.')
                    ->line('**Информация о квартире:**')
                    ->line("Адрес: " . ($property->address ?? 'Не указан'))
                    ->line("ID квартиры: {$property->id}")
                    ->line('**Информация о пользователе:**')
                    ->line("ФИО: " . trim(($user->last_name ?? '') . ' ' . ($user->first_name ?? '') . ' ' . ($user->middle_name ?? '')))
                    ->line("Email: " . ($user->email ?? 'Не указан'));

                // Добавляем сообщение если оно есть
                if (!empty($this->propRequest->message)) {
                    $mailMessage->line('**Сообщение от пользователя:**')
                               ->line($this->propRequest->message);
                }

                // Добавляем ссылку на просмотр заявки
                $url = url('/admin/property-requests/');
                $mailMessage->action('Просмотреть заявку', $url);
    
                return $mailMessage->line('Спасибо за использование нашего сервиса!');
            }
        } catch (\Exception $e) {
            Log::error('Error in NewPropertyRequestNotification->toMail: ' . $e->getMessage(), [
                'prop_request_id' => $this->propRequest->id ?? null,
                'notifiable_id' => $notifiable->id ?? null,
                'exception' => $e
            ]);
            
            // Возвращаем базовое уведомление в случае ошибки
            return (new MailMessage)
                ->subject('Новая заявка на квартиру')
                ->greeting('Здравствуйте!')
                ->line('Получена новая заявка на квартиру.')
                ->line('Произошла ошибка при формировании детальной информации.')
                ->line('Пожалуйста, проверьте заявки в административной панели.');
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'property_request_id' => $this->propRequest->id,
            'property_id' => $this->propRequest->property_id ?? null,
            'user_id' => $this->propRequest->user_id ?? null,
        ];
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Exception $exception)
    {
        Log::error('NewPropertyRequestNotification failed', [
            'prop_request_id' => $this->propRequest->id ?? null,
            'exception' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
}