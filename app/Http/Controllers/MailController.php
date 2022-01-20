<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyUserBan;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function sendEmail($email) {
        $email = $email;
   
        $mailData = [
            'title' => 'You are now banned.',
            'url' => 'e-barter.co/appeal'
        ];
  
        Mail::to($email)->send(new NotifyUserBan($mailData));
   
        return response()->json([
            'message' => 'Email has been sent.'
        ], Response::HTTP_OK);
    }
}
