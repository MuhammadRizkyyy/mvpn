<?php

namespace App\Mail;

use App\Models\Membership;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MembershipStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Membership $membership)
    {
    }

    public function build()
    {
        $subject = match ($this->membership->status) {
            'verified' => 'Data Pendaftaran Anda Telah Terverifikasi',
            'interview' => 'Undangan Interview / Member Assessment',
            'accepted' => 'Selamat, Anda Diterima sebagai Anggota MVP.N',
            'rejected' => 'Informasi Status Pendaftaran Keanggotaan Anda',
            default => 'Update Status Pendaftaran Keanggotaan',
        };

        return $this->subject($subject)
            ->view('emails.membership-status');
    }
}
