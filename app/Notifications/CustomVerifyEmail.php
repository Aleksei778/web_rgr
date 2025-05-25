<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmailBase implements ShouldQueue
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        try {
            \Log::info('Generating verification URL for user: ' . $notifiable->email);
            $verificationUrl = $this->verificationUrl($notifiable);
            \Log::info('Verification URL generated: ' . $verificationUrl);

            // Проверяем, существует ли шаблон auth.email
            if (view()->exists('auth.email')) {
                return (new MailMessage)
                    ->subject('Подтверждение вашего email')
                    ->view('auth.email', ['url' => $verificationUrl, 'user' => $notifiable]);
            } else {
                // Используем стандартный шаблон, если кастомный не найден
                return (new MailMessage)
                    ->subject('Подтверждение вашего email')
                    ->line('Нажмите кнопку ниже для подтверждения вашего email адреса.')
                    ->action('Подтвердить email', $verificationUrl)
                    ->line('Если вы не создавали учетную запись, просто проигнорируйте это письмо.');
            }
        } catch (\Exception $e) {
            \Log::error('Error in CustomVerifyEmail->toMail: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60), // Ссылка действительна 60 минут
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
