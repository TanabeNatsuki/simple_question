<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\MainRequest;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Point;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Mail\RegisterShipped;
use App\Mail\OrderMail;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

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
  protected $redirectTo = RouteServiceProvider::HOME;

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

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  public function pre_check(RegisterRequest $request)
  {
    $request->flashOnly( 'email');
    $bridge_request = $request->all();
    $bridge_request['password_mask'] = '*******';
    return view('auth.register_check')->with($bridge_request);
  }

  protected function create(array $data)
  {
    $user = User::create([
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);

    $email = new EmailVerification($user);
    Mail::to($user->email)->send($email);

    return $user;
  }

  public function register(Request $request)
  {
      event(new Registered($user = $this->create( $request->all() )));

      return view('auth.registered');
  }

 public function mainRegister(Request $request)
 {
   $user = User::where('email',$request->email)->first();
   $point = new Point;
   $point->point = 0;
   $point->save();
   $user->point_id = $point->id;
   $user->status = config('const.USER_STATUS.REGISTER');
   $user->name = $request->name;
   $user->save();

   return view('auth.main.main_registered',compact('user','email_token'));
 }
}
