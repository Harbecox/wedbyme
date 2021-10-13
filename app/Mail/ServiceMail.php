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
        $this->telegram();
    }

    function telegram(){
        $msg = $this->urls['front']."\n";
        $msg.= $this->urls['admin'];
        $url = 'https://api.telegram.org/bot2087911716:AAHhXCxyMnVb8c1QmstHmiNyusDynGv_JI4/sendMessage?chat_id=-672072736&text='.$msg;
        file_get_contents($url);
    }

    public function build()
    {
        return $this->view('hallMail')->with(['urls' => $this->urls]);
    }
}
