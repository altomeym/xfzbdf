<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class DownloadGuideLead extends Mailable
{
    use Queueable, SerializesModels;
    public $guide;
   
    public function __construct($guide)
    {
        $this->guide = $guide;
    }
    public function build()
    {
        return $this->markdown('email.guide-lead-download');
    }
}