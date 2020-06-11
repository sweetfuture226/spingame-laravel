<?php
 namespace App\Http\Controllers;
 use Illuminate\Http\Request;
 use Validator,Redirect,Response,File;
 use Socialite;
 use App\SocialUsers;
 class SocialController extends Controller
 {
 public function redirect($provider)
 {
     return Socialite::driver($provider)->redirect();
 }
 public function callback($provider)
 {
   $getInfo = Socialite::driver($provider)->user(); 
   $user = $this->createUser($getInfo,$provider); 
   auth()->login($user); 
   return redirect()->to('/home');
 }
 function createUser($getInfo,$provider){
 $user = SocialUsers::where('provider_id', $getInfo->id)->first();
 if (!$user) {
      $user = SocialUsers::create([
         'name'     => $getInfo->name,
         'email'    => $getInfo->email,
         'provider' => $provider,
         'provider_id' => $getInfo->id
     ]);
   }
   return $user;
 }
 }