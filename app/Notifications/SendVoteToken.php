<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendVoteToken extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected string $voteToken = '',
        protected string $voteTime = ''
    ) {}

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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('PEMILIHAN KETUA DAN WAKIL KETUA HMSI ' . date('Y'))
            ->greeting('Halo ' . $notifiable->name . ',')
            ->line(
                'Pelaksanaan PEMIRA Ketua dan Wakil Ketua HMSI akan segera dimulai pada : <br/>' .
                '🗓️ : 24 November ' . date('Y') . '<br/>' .
                '📍 : Website PEMIRA HMSI ' . date('Y')
            )
            ->line(
                'Untuk memberikan suara, kamu dapat menggunakan token pemilihan berikut :<br/>' .
                '🔑 Token Pemilihan : ' . $this->voteToken . '<br/>' .
                '⏰ Waktu Pemilihan : ' . $this->voteTime
            )
            ->line('Silakan kunjungi tautan berikut untuk memberikan suara Anda :')
            ->action('Lakukan Pemilihan', url('/vote'))
            ->line('Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi kami.')
            ->line('Selamat memilih!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
