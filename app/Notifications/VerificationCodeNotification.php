<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationCodeNotification extends Notification
{
    private $code, $expireAt;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string|int $code, Carbon $expireAt)
    {
        $this->code = $code;
        $this->expireAt = $expireAt;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Verification Code |" . config("app.name"))
            ->greeting("Hello .")
            ->line("This is your Verification Code")
            ->line("_" . $this->code . "_")
            ->line("Your Verification Code will expire at " . $this->expireAt->toDateTimeString());
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
