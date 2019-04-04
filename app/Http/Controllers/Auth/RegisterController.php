<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/confirm';

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
            'name'     => 'required|max:255',
            'username' => 'sometimes|required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
        // $data['confirmation_code'] = str_random(25);
        // $fields = [
            $user = User::create([

                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
                'UsSlug'   => $data['name'].mt_rand(1,999),
                'UsRol'    => "Usuario",
                'UsRolDesc'    => "Usuario General",
                'UsRol2'    => "Usuario",
                'UsRolDesc2'    => "Usuario General",
                'UsAvatar'    => "robot400x400.gif",
                // 'FK_UserPers'    => "1",
                'confirmation_code' => $data['name'].mt_rand(1,999),
                // 'confirmed' => "0",
            ]);
            
        // ];
        // if (config('auth.providers.users.field', 'email') === 'username' && isset($data['username'])) {
        //     $fields['username'] = $data['username'];
        // }
        
        
        // return User::create($fields);
        // return $user;

        // $confirmation_code = $user->confirmation_code;
        Mail::send('emails.confirmation_code', $data,  function($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Confirmación de Correo');
        });


        // return redirect()->route('auth.confirm');
    }

    public function verify($email)
    {
        $user = User::where('confirmation_code', $email)->first();
// return $confirmation_code;
        if (! $user){
            return redirect()->route('auth.register');
        }else{

            $user->confirmation_code = null;
            $user->email_verified_at = now();
            $user->save();
    
            return redirect()->route('clientes.create')->with('notification', 'Has confirmado correctamente tu correo!');
        }

    }
}
