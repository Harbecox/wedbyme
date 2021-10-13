<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HallMail extends Mailable
{
    use Queueable, SerializesModels;

    private $urls;

    public function __construct($hall)
    {
        $this->urls = [
            "front" => "http://wedbyme.am/".$hall->company->seo_url."/service/".$hall->seo_url,
            "admin" => "http://wedbyme.am/admin/services/".$hall->id
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('hallMail')->with(['urls' => $this->urls]);
    }
}
