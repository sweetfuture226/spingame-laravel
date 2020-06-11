<?php

namespace App\Http\Controllers;

use App\Invite;
use App\Mail\InviteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function invite()
    {
        // show the user a form with an email field to invite a new user
        return view('invite');
    }

    public function process(Request $request)
    {
        // process the form submission and send the invite by email
        // validate the incoming request data

        do {
            //generate a random string using Laravel's str_random helper
            $token = str_random();
        } //check if the token already exists and if it does, try again
        while (Invite::where('token', $token)->first());

        //create a new invite record
        $invite = Invite::create([
            'email' => $request->get('email'),
            'token' => $token
        ]);

        // send the email
        Mail::to($request->get('email'))->send(new InviteMail($invite));

        // redirect back where we came from
        // return redirect()
        //         ->back();
        return redirect()->route('invite');
    }

    public function accept($token)
    {
        // here we'll look up the user by the token sent provided in the URL
    }
}
