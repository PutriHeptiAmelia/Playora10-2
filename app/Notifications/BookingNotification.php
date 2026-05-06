<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class BookingNotification extends Notification
{
    protected $message;
    protected $booking;

    public function __construct($booking, $message)
    {
        $this->booking = $booking;
        $this->message = $message;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'lapangan' => $this->booking->lapangan->nama,
            'tanggal' => $this->booking->tanggal,
            'jam_mulai' => $this->booking->jam_mulai,
            'jam_selesai' => $this->booking->jam_selesai,
            'total_harga' => $this->booking->total_harga,
            'status' => $this->booking->status,
            'message' => $this->message,
        ];
    }
}