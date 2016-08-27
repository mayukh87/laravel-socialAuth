<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/admin/home';
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function getEmail()
    {
        return view('admin.auth.passwords.email');
    }

    protected function getEmailSubject()
    {
       return isset($this->subject) ? $this->subject : 'Your Password Reset Link';
    }
    
    public function getReset($token = null)
    {
       if (is_null($token)) {
           throw new NotFoundHttpException;
       }

       return view('admin.auth.passwords.reset')->with('token', $token);
    }
    
    public function postReset(\Illuminate\Http\Request $request)
    {
       $this->validate($request, [
           'token' => 'required',
           'email' => 'required|email',
           'password' => 'required|confirmed',
       ]);

       $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
       );

       $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
       });

       switch ($response) {
            case Password::PASSWORD_RESET:
                return redirect($this->redirectPath());

           default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
       }
    }
}
