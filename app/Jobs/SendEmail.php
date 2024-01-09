<?php

namespace App\Jobs;

use App\Mail\MailNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $data;

    protected $users;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $users)
    {
        $this->data = $data;
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // foreach ($this->users as $user) {
        //     Mail::to($user->email)->send(new MailNotify($this->data));
        // }
        // for ($i = 0; $i < count($this->users); $i++) {
        //     Mail::to($this->users[$i]['email'])
        //         ->send(new MailNotify($this->data))
        //     ;
        // }
    }
}
