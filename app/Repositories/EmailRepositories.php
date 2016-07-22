<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Mail;

class EmailRepositories
{
    public function sendEmailReminder($user)
    {
        Mail::send('emails.notification', ['user' => $user], function ($message) {
            $message->to('nuel.4r17@gmail.com', 'Go-Dashboard Admin')->from($this->getSenderEmail())->subject('Register Successfully');
        });
    }

    public function getSenderEmail()
    {
        return \Config::get('mail.from.address');
    }

    public function getSenderName()
    {
        return \Config::get('mail.from.name');
    }
}
