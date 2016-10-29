<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';
    protected $redirectAfterLogout = '/admin/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
    }

    public function getLoginForm() {
        return view('admin.auth.login');
    }

    public function showRegistrationForm() {
        return view('admin.auth.register');
    }

    public function register(\Illuminate\Http\Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                    $request, $validator
            );
        }

        // Removed to prevent auto login
        Auth::guard($this->getGuard())->login($this->create($request->all()));
        $this->create($request->all());

        return redirect($this->redirectPath());
    }

    public function postRegister() {
        return redirect('/admin/home');
    }

    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->user();

        $data = [
            'name' => $user->getName(),
            'email' => $user->getEmail()
        ];

        Auth::login(User::firstOrCreate($data));

        return redirect('/admin/home');
    }

}
