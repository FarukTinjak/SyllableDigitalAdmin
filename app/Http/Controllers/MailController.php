<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    /**
     * Send plain text email
     */
    public function mail(Request $request)
    {
        $data = array(
            'full_name'=>$request->full_name,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'content'=>$request->message
        );
        // Path or name to the blade template to be rendered
        $template_path = 'email/contact';

        Mail::send($template_path, $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to('fare_tc@hotmail.com')->subject('Syllable Digital Contact Form');
            // Set the sender
            $message->from(config('mail.mailers.smtp.username'),'Syllable Digital Contact form');
        });

        return "Basic email sent, check your inbox.";
    }
}

