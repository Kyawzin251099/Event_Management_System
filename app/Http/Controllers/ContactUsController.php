<?php

namespace App\Http\Controllers;

use App\Mail\VisitorContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function submitContactUsForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'subject' => 'required',
            'email' => 'required|email',
            'body' => 'required'
        ]);
        $mail_data = [
            'name' => $request->name,
            'fromEmail' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body
        ];
        if (!$mail_data) {
            return response()->json([
                'Failed,Message was not sent.'
            ], 401);
        }

        Mail::to(config('mail.from.address'))->send(new VisitorContact($mail_data));
        // Mail::to(env('MAIL_USERNAME'))->send(new VisitorContact($mail_data));
        //$return_data = new ContactUsResource($mail_data);

        return response()->json([
            'message' => 'Message was sent successfully',
        ], 200);
    }
}


        // $validatedData = $request->validated();
        // $data = [
        //     'name' => $validatedData['name'],
        //     'email' => $validatedData['email'],
        //     'message' => $validatedData['message'],
        // ];

// Mail::send('emails.contact', $mail_data, function($message) use ($mail_data){
        //     $message->to($mail_data['recipient'])
        //             ->from($mail_data['fromEmail'])
        //             ->subject($mail_data['subject']);

       // });
