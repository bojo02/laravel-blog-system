<?php

namespace App\Jobs;

use App\Mail\NewsLetterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendNewsLetterToSubs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

     protected $title;
     protected $content;
     protected $subject;
     protected $email;
     protected $name;
    public function __construct($newsLetter, $sub)
    {
        $this->title = $newsLetter->title;
        $this->content = $newsLetter->content;
        $this->subject = $newsLetter->subject;
        $this->email = $sub->email;
        $this->name = $sub->name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new NewsLetterMail([
            'title' => $this->title,
            'content'=> $this->content,
            'name'=> $this->name,
        ]));
    }
}
