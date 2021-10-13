<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiceMail extends Mailable
{
    use Queueable, SerializesModels;

    private $urls;

    public function __construct($service)
    {
        $this->urls = [
            "front" => "http://wedbyme.am/".$service->company->seo_url."/service/".$service->seo_url,
            "admin" => "http://wedbyme.am/admin/services/".$service->id
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
