<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller {



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function test()
    {
        //

        Mail::send('emails.invite', ['email' => 'boris@kesato.com'], function ($message) {

            $message->from('boris@kesato.com', 'Kibarer');

            $message->to('boris@kesato.com', 'boris@kesato.com')->subject('Kibarer Administrator Account Registration');
        });
    }



    public function invite(Request $request) {
        //
        $user = new User;

        $user->email = $request->email;

        $user->role_id = $request->role;

        $password = str_random(8);

        $user->password = bcrypt($password);


        Mail::send('emails.invite', ['email' => $user->email, 'password' => $password], function ($message) use ($user) {

            $message->from('boris@kesato.com', 'Kibarer');

            $message->to($user->email, $user->email)->subject('Kibarer Administrator Account Registration');
        });


        $user->save();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'recipient notified', 'message' => 'We have emailed the recipient with a link and password to create an account. Password: ' . $password)));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = User::where('email', $request->email);

        if($user->password != bcrypt($request->password)) return reponse()->json(['status' => 403, 'message' => 'Wrong credential. No matching account with those credentials found!']);

        $user->username = $request->username;
        $user->position_id = $request->position_id; // REMOVE?
        $user->branch_id = $request->branch_id;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->province = $request->province;
        $user->country = $request->country;
        $user->zipcode = $request->zipcode;

        $user->active = 1;

        if(Input::hasFile('profile_pic')) {

            $pp = Input::get('profile_pic');

            $extension = $pp->getClientOriginalExtension();

            $fileName = $user->username . '.' . $extension;

            $pp->move(public_path('media/agents'), $user->username . '.' . $extension);
        }

        $user->image = $fileName;

        $user->save();

        return redirect('/admin/account');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $user = User::find($id);

        return $user;
    }


    public function update(Request $request)
    {

        $user = User::find($request->user_id);

        $validator = \Validator::make($request->all(), [
            'username' => 'required|unique:Users,username,'. $user->id,
            'email' => 'required|unique:Users,email,'. $user->id,
            'firstname' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->branch_id = $request->branch_id;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->province = $request->province;
        $user->country = $request->country;
        $user->zipcode = $request->zipcode;

        $user->active = $request->active;

        if ($request->password) $user->password = \Hash::make($request->password);

        // if ($request->hasFile('file')) {

        //     if ($user->image) {
        //         \File::delete('uploads/user/' . $user->image);
        //     }

        //     $destinationPath = 'uploads/user';
        //     $extension = $request->file('file')->getClientOriginalExtension();
        //     $fileName = date('YmdHis') . '_' . strtolower($request->firstname) . '_user' . '.' . $extension;

        //     $request->file('file')->move($destinationPath, $fileName);

        //     $user->image = $fileName;

        // }

        $user->save();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'account updated', 'message' => 'Account has been updated.')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user = User::find($id);

        $user->delete();
        
        return response()->json(array('status' => 200, 'monolog' => array('title' => 'account updated', 'message' => 'Account has been updated.'), 'id' => $id));
    }

    public function storeProfile(Request $request)
    {

        $user = User::find($request->edit);

        $validator = \Validator::make($request->all(), [
            'username' => 'required|unique:Users,username,'. $user->id,
            'email' => 'required|unique:Users,email,'. $user->id,
            'firstname' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        $user->username = $request->username;
        $user->email = $request->email;
        // $user->position_id = $request->position_id;
        $user->branch_id = $request->branch_id;

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->province = $request->province;
        $user->country = $request->country;
        $user->zipcode = $request->zipcode;

        if ($request->password) $user->password = \Hash::make($request->password);

        if ($request->hasFile('file')) {

            if ($user->image) {
                \File::delete('uploads/user/' . $user->image);
            }

            $destinationPath = 'uploads/user';
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = date('YmdHis') . '_' . strtolower($request->firstname) . '_user' . '.' . $extension;

            $request->file('file')->move($destinationPath, $fileName);

            $user->image = $fileName;

        }

        $user->save();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'account updated', 'message' => 'Account has been updated.')));

    }

}
