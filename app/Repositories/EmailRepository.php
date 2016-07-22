<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Mail;

class EmailRepository
{
    public function sendEmailNotification($user)
    {
        Mail::send('emails.notification', ['user' => $user], function ($message) {
            $message->to('nuel.4r17@gmail.com', 'Go-Dashboard Admin')->from($this->getSenderEmail())->subject('Register Successfully');
        });
    }

    public function sendEmailReport($count)
    {
        Mail::send('emails.report', ['user' => $count], function ($message) {
            $message->to('nuel.4r17@gmail.com', 'Go-Dashboard Admin')->from($this->getSenderEmail())->subject('Report of User');
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
