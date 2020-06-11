<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ContactUSController extends Controller
{
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function contactUS()
   {
       return view('contact');
   }

   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   public function contactUSPost(Request $request)
   {
       $this->validate($request, [
        'email' => 'required|email',
        'message' => 'required'
        ]);

       if ( mail("thriftgift@usibaservices.co.uk",'Contact US',$request->message,$request->email)) {
         return back()->with('success', 'Thanks for contacting us!');
       }else {
         return back()->with('error', 'Thanks for contacting us!');
       }

       
   }
}