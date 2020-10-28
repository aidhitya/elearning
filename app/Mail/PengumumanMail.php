<?php

namespace App\Mail;

use App\Models\Pengumuman;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PengumumanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengumuman;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pengumuman $pengumuman)
    {
        $this->pengumuman = $pengumuman;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->pengumuman->author->email)
        ->view('pages.mails.pengumuman')
        ->with([
            'judul' => $this->pengumuman->judul,
            'isi' => $this->pengumuman->isi,
            'gambar' => $this->pengumuman->gambar,
            'created_at' => $this->pengumuman->created_at,
        ]);
    }
}
