<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $result_array = array('result' => 'success', 'url' => route('home'));
            return response()->json($result_array);
        }

        $result_array = array('result' => 'fail');
        return response()->json($result_array);
    }
    /**
 * Attempt to log the user into the application.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return bool
 */

    protected function attemptLogin(Request $request){
        return Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    }
}
