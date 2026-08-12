<?php

namespace App\Mail;

use App\Models\Partnership;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartnershipStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Partnership $partnership)
    {
    }

    public function build()
    {
        $subject = $this->partnership->status === 'approved'
            ? 'Pengajuan Kerjasama Anda Disetujui'
            : 'Pengajuan Kerjasama Anda Ditolak';

        return $this->subject($subject)
            ->view('emails.partnership-status');
    }
}
