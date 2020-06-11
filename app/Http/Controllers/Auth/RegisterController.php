<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'password' => Hash::make($data['password']),
            // 'state' => $data['state'],
        ]);
    }

    public function register(Request $request)
    {
        if (!$this->checkEmail($request->email)) {
            return response()->json(['result' => 'error', 'msg' => 'Email Already Taken']);
        }
        if (!$this->checkFirstName($request->firstname) && !$this->checkLastName($request->lastname)) {
            return response()->json(['result' => 'error', 'msg' => 'User name Already Taken']);
        }
        // if ($request->confirmemail!=$request->email) {
        //     return response()->json(['result' => 'error', 'msg' => 'Check your email again']);
        // }
        if ($request->confirmpassword!=$request->password) {
            return response()->json(['result' => 'error', 'msg' => 'Check your password again']);
        }
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        event(new Registered($user));

        //$this->guard()->login($user);

        /*Mail::raw('<h1>Hi there $request->username</h1><hr/><p>Click <a href ="'.route('verifyemail').'?nonce=$user->verify_nonce"> here</a> to complete the registration.</p><hr/><footer>Mail from '.config('app.url').'</footer>', function($message)
        {
          global $request;
          $message->subject('Thank you for using our service.');
          $message->from('thriftgift@usibaservices.co.uk', 'playthriftgift.com');
          $message->to($request->email);
        });*/


        // $to = $request->email;
        // $subject = 'Thank you for using our service.';
        // $data = [
        //     'title' => 'Hi there',
        //     'nonce'  => $user->verify_nonce,
        //     'user'  => $request->username
        // ];
        // Mail::to($to)->send(new RegisterMail($data));
        /*Mail::send('auth/registerverifymail', $data, function($message) use($to, $subject) {
            $message->to($to)->subject($subject);
        });*/
        
        $result_array = array('result' => 'success', 'url' => route('welcome'));
        return response()->json($result_array);
    }

    public function checkEmail($email)
    {
        $emailCount = User::where('email', $email)->count();
        if($emailCount != 0){
            return false;
        }else{
            return true;
        }
    }
    public function checkFirstName($firstname)
    {
        $fnameCount = User::where('firstname', $firstname)->count();
        if($fnameCount != 0){
            return false;
        }else{
            return true;
        }
    }
    public function checkLastName($lastname)
    {
        $lnameCount = User::where('lastname', $lastname)->count();
        if($lnameCount != 0){
            return false;
        }else{
            return true;
        }
    }

}
