<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Session;
use App\User;
/**
 * Description of WelcomeController
 *
 * @author admin11
 */
class WelcomeController {
    //put your code here
    public function verifyEmail(Request $request){
        $user=DB::select('SELECT * FROM users WHERE verify_nonce=?',[$request->nonce]);
        if($user){
            $user=DB::update('UPDATE users SET email_verified_at=? ,activated=? WHERE id=?',[date("Y-m-d H:i:s"),1,$user[0]->id]);
            Session::flash('message', 'verified your email!');
            return view('welcome');
            //return redirect()->route('home');
        }else{
            Session::flash('message', 'invalid email!');
            return view('welcome');
        }
    }
    public function passwordReset(Request $request){
        return view('resetpassword',['nonce'=>$request->nonce]);
    }
    public function passwordResetConfirm(Request $request){
        $user=DB::select('SELECT * FROM users WHERE verify_nonce=?',[$request->nonce]);
        if($user){
            $user=DB::update('UPDATE users SET password=?,activated=? WHERE id=?',[Hash::make($request->newpassword),1,$user[0]->id]);
            Session::flash('message', 'your password has been reseted');
            return view('welcome');
            //return redirect()->route('home');
        }else{
            Session::flash('message', 'invalid try!');
            return view('welcome');
        }
    }
    public function lostPassword(Request $request){
        $user = User::whereEmail($request->email)->first();
        
        if($user){
            $to = $request->email;
            $subject = 'Lost Password Reset.';
            $nonce=md5($user->password.$user->email);
            $data = [
                'title' => 'Hi there',
                'nonce'  => $nonce,
                'user'  => $user->username
            ];

            Mail::send('auth/resetpasswordmail', $data, function($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            });
            $user=DB::update('UPDATE users SET verify_nonce=? WHERE id=?',[$nonce,$user->id]);
            Session::flash('message', 'We have sent password reset link to your email!');
            return view('welcome');
            //return redirect()->route('home');
        }else{
            Session::flash('message', 'invalid email!');
            return view('welcome');
        }
    }
}
