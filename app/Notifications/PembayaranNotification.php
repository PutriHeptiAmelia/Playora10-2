<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class PembayaranNotification extends Notification
{
    protected $message;
    protected $pembayaran;

    public function __construct($pembayaran, $message)
    {
        $this->pembayaran = $pembayaran;
        $this->message = $message;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'pembayaran_id' => $this->pembayaran->id,
            'booking_id' => $this->pembayaran->booking_id,
            'jumlah' => $this->pembayaran->jumlah,
            'status' => $this->pembayaran->status,
            'message' => $this->message,
        ];
    }
}