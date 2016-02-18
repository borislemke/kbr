<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Customer;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use Auth;
use Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin()
    {
        if (Auth::user()->check()) return redirect('admin/dashboard');

        return view('auth.login');
    }


    public function postLogin(Request $request)
    {
        $field = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $request->merge([$field => $request->input('email')]);

        $auth = $this->authenticate($request, $request->remember, $field);

        if ($auth == 'user') return response()->json(array('log' => 1, 'redirect' => '/admin/dashboard'));

        if ($auth == 'customer') return redirect('account');

        return redirect()->back();
    }


    public function authenticate(Request $request, $remember, $field)
    {
        if (Auth::user()->attempt($request->only($field, 'password'), $remember)) {

            return 'user';
        }

        if (Auth::customer()->attempt($request->only($field, 'password'), $remember)) {

            return 'customer';
        }
    }


    public function getLogout()
    {
        if (Auth::user()->check()) {
            Auth::user()->logout();
            return redirect('auth/login');
        }

        if (Auth::customer()->check()) {
            Auth::customer()->logout();
            return redirect()->route('login', trans('url.login'));
        }

        return redirect()->back();

    }


    // Customer registration
    public function postRegister(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:customers',
            'password' => 'required|confirmed',
            'firstname' => 'required',
            'city' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => $validator->errors() )));
        }


        $confirmation_code = str_random(30);

        $customer = new Customer;

        $customer->username = $customer->getUsername($request->firstname);
        $customer->email = $request->email;
        $customer->password = \Hash::make($request->password);
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->address = $request->address;

        // find province, country
        $city = \App\City::where('city_name', $request->city)->first();

        $customer->city = $request->city;
        $customer->province = $city->province->province_name;
        $customer->country = $city->province->country->nicename;

        $customer->confirmation_code = $confirmation_code;

        $customer->save();

        // send confirm email
        $this->sendConfirmationEmail($customer->firstname, $customer->email, $confirmation_code);

        // $request->session()->flash('alert-success', 'Thankyou for registration. Please check your email address to activate your account.');

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'success', 'message' => 'Thanks. Your property has been sent successfully.')));
    }

    public function sendConfirmationEmail($firstname, $email, $confirmation_code)
    {

        Mail::send('emails.confirm', ['firstname' => $firstname, 'confirmation_code' => $confirmation_code], function($message) use ($email) {

            $message->from('boris@kesato.com', 'Kibarer');

            $message->to($email, $email)->subject('Verify your email address');
        });

        return true;
    }

    public function getCustomerLogin()
    {        
        if (\Auth::customer()->check()) return redirect()->route('account', trans('url.account'));

        return view('pages.login');
    }

    public function getCustomerRegister()
    {        
        //
        if (\Auth::customer()->check()) return redirect()->route('account', trans('url.account'));

        return view('pages.register');
    }


    public function confirm($confirm, $confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw \App::abort(404);
        }

        $customer = \App\Customer::where('confirmation_code', $confirmation_code)->first();

        if ( ! $customer)
        {
            throw \App::abort(404);
        }

        $customer->active = 1;
        $customer->confirmed = 1;
        $customer->confirmation_code = null;
        $customer->save();

        return redirect()->route('login', trans('url.login'))->with('alert-success', 'You have successfully verified your account.');;
    }

}
