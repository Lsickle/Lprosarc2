<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
// use Mail;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $user = Auth::user();
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
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            // 'g-recaptcha-response' => 'required|captcha',
            // 'terms'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
                'name'          => $data['name'],
                'email'         => $data['email'],
                'password'      => bcrypt($data['password']),
                'UsSlug'        => hash('sha256', rand().time().$data['email']),
                'UsRol'         => "Cliente",
                'UsRolDesc'     => "Usuario General",
                'UsRol2'        => "Cliente",
                'UsRolDesc2'    => "Usuario General",
                'UsAvatar'      => "robot400x400.gif",
                // 'FK_UserPers'    => "1",
                // 'confirmation_code' => $data['name'].mt_rand(1,999),
                // 'confirmed' => "0",
            ]);
        
        // $confirmation_code = $user->confirmation_code;
        // Mail::send('emails.confirmation_code', $data, function($message) use ($data) {
        //     $message->to($data['email'], $data['name'])->subject('Confirmación de Correo');
        // });
        // // return redirect()->route('auth.confirm');
        // return $user;
    }

//     public function verify($email)
//     {
//         $user = User::where('email', $email)->first();
// // return $confirmation_code;
//         if (! $user){
//             return redirect()->route('auth.register');
//         }else{

//             $user->confirmation_code = null;
//             $user->email_verified_at = now();
//             $user->save();
    
//             return redirect('clientes/create')->with('notification', 'Has confirmado correctamente tu correo!');
//         }

//     }
}
