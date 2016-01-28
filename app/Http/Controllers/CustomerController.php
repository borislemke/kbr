<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;

use DB;
use Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        if ($request->edit != 0) return $this->update($request, $request->edit);


        $validator = \Validator::make($request->all(), [
            'firstname' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        DB::beginTransaction();

        $customer = new Customer;

        $customer->username = $request->email;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->address = $request->address;
        $customer->phone = $request->phone;

        $customer->city = ucwords($request->city);
        $customer->province = $request->province;
        $customer->country = $request->country;
        $customer->zipcode = $request->zipcode;

        $customer->facebook = $request->facebook;
        $customer->twitter = $request->twitter;

        // $customer->image_profile = $request->image_profile;
        $customer->newsletter = $request->newsletter;
        $customer->active = $request->active;

        $customer->save();

        DB::commit();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'post success', 'message' => 'Post has been received')));
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
        $customer = Customer::find($id);

        return $customer;
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

        $validator = \Validator::make($request->all(), [
            'firstname' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        DB::beginTransaction();

        $customer = Customer::find($id);

        $customer->username = $request->email;
        $customer->email = $request->email;
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->address = $request->address;
        $customer->phone = $request->phone;

        $customer->city = ucwords($request->city);
        $customer->province = $request->province;
        $customer->country = $request->country;
        $customer->zipcode = $request->zipcode;

        $customer->facebook = $request->facebook;
        $customer->twitter = $request->twitter;

        // $customer->image_profile = $request->image_profile;
        $customer->newsletter = $request->newsletter;
        $customer->active = $request->active;

        if ($request->password) $customer->password = Hash::make($request->password);

        $customer->save();

        DB::commit();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'update success', 'message' => 'Customer has been updated')));
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
        $customer = Customer::find($id);

        $customer->delete();

        // return redirect()->back();
        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'Customer has been deleted'), 'id' => $id));
    }
}
