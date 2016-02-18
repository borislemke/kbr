<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $category = $request->category;
        $status = $request->status;

        // datatable parameter
        $draw = $request->draw;
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];

        // sorting
        $column = 'id';
        $sort = $request->order[0]['dir'] ? $request->order[0]['dir'] : 'desc'; //asc

        // new object
        $users = new User;

        $users = $users->select('users.*')
            ->join('branches', 'branches.id', '=', 'users.branch_id');

        $users = $users->with('branch');

        // searching
        if ($search) {

            $users = $users->where(function ($q) use ($search) {
                    $q->where('users.username', 'like', $search . '%')
                        ->orWhere('users.firstname', 'like', $search . '%');
                });
        }

        // total records
        $count = $users->count();

        // pagination
        $users = $users->take($length)->skip($start);

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            if ($column == 'branch.name') {

                $users = $users->orderBy('branches.name', $sort);
            } else {

                $users = $users->orderBy('users.' . $column, $sort);
            }

        } else {

            $users = $users->orderBy('users.' . $column, $sort);
        }

        // get data
        $users = $users->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $users

            ];

        return $respose;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'firstname' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }
        
        $user = new User;

        $user->username = $user->getUsername($request->firstname);
        $user->email = $request->email;

        // pass: kibarer // $2y$10$STb5v6UVqr7ZxGj2ixQvseLTpW14aYUiIdKtyUrESkXCh6EAmmXju
        $user->password = \Hash::make($request->password);

        // $user->remember_token = $request->remember_token;
        // $user->confirmation_code = $request->confirmation_code;
        // $user->confirmed = $request->confirmed;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->phone = $request->phone;

        // find province, country
        $city = \App\City::where('city_name', $request->city)->first();

        $user->city = $request->city;
        $user->province = $city->province->province_name;
        $user->country = $city->province->country->nicename;

        // $user->zipcode = $request->zipcode;

        // $user->image_profile = $request->image_profile;

        $user->role_id = $request->role_id;

        $user->branch_id = $request->branch_id;

        $user->active = 1;

        $user->save();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'success', 'message' => 'object has been saved')));        

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $user = User::find($id);

        $validator = \Validator::make($request->all(), [
            // 'username' => 'required|unique:users,username,'. $user->id,
            'email' => 'required|unique:users,email,'. $user->id,
            'firstname' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        // $user->username = $user->getUsername($request->firstname);
        $user->email = $request->email;

        // pass: kibarer // $2y$10$STb5v6UVqr7ZxGj2ixQvseLTpW14aYUiIdKtyUrESkXCh6EAmmXju
        if ($request->password)
            $user->password = \Hash::make($request->password);

        // $user->remember_token = $request->remember_token;
        // $user->confirmation_code = $request->confirmation_code;
        // $user->confirmed = $request->confirmed;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->phone = $request->phone;

        // find province, country
        $city = \App\City::where('city_name', $request->city)->first();

        $user->city = $request->city;
        $user->province = $city->province->province_name;
        $user->country = $city->province->country->nicename;

        // $user->zipcode = $request->zipcode;

        $user->role_id = $request->role_id;

        $user->branch_id = $request->branch_id;

        $user->active = $request->active;

        $user->save();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'success', 'message' => 'object has been updated')));    
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

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));

    }
}
