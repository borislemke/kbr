<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Customer;

class CustomerController extends Controller
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
        $customers = new Customer;

        // searching
        if ($search) {

            $customers = $customers->where(function ($q) use ($search) {
                    $q->where('customers.username', 'like', $search . '%')
                        ->orWhere('customers.firstname', 'like', $search . '%');
                });
        }

        // total records
        $count = $customers->count();

        // pagination
        $customers = $customers->take($length)->skip($start);

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            $customers = $customers->orderBy('customers.' . $column, $sort);

        } else {

            $customers = $customers->orderBy('customers.' . $column, $sort);
        }

        // get data
        $customers = $customers->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $customers

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
        $customer = new Customer;

        $customer->username = $customer->getUsername($request->firstname);
        $customer->email = $request->email;

        // pass: kibarer // $2y$10$STb5v6UVqr7ZxGj2ixQvseLTpW14aYUiIdKtyUrESkXCh6EAmmXju
        $customer->password = \Hash::make($request->password);

        // $customer->remember_token = $request->remember_token;
        // $customer->confirmation_code = $request->confirmation_code;
        // $customer->confirmed = $request->confirmed;
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->address = $request->address;
        $customer->phone = $request->phone;

        // find province, country
        $city = \App\City::where('city_name', $request->city)->first();

        $customer->city = $request->city;
        $customer->province = $city->province->province_name;
        $customer->country = $city->province->country->nicename;

        $customer->zipcode = $request->zipcode;

        $customer->facebook = $request->facebook;
        $customer->twitter = $request->twitter;

        // $customer->image_profile = $request->image_profile;

        $customer->newsletter = 1;

        $customer->active = 1;

        $customer->save();

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
        $customer = Customer::find($id);

        // $customer->username = $customer->getUsername($request->firstname);
        $customer->email = $request->email;

        // pass: kibarer // $2y$10$STb5v6UVqr7ZxGj2ixQvseLTpW14aYUiIdKtyUrESkXCh6EAmmXju
        if ($request->password)
            $customer->password = \Hash::make($request->password);

        // $customer->remember_token = $request->remember_token;
        // $customer->confirmation_code = $request->confirmation_code;
        // $customer->confirmed = $request->confirmed;
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->address = $request->address;
        $customer->phone = $request->phone;

        // find province, country
        $city = \App\City::where('city_name', $request->city)->first();

        $customer->city = $request->city;
        $customer->province = $city->province->province_name;
        $customer->country = $city->province->country->nicename;

        $customer->zipcode = $request->zipcode;

        $customer->facebook = $request->facebook;
        $customer->twitter = $request->twitter;

        // $customer->image_profile = $request->image_profile;

        // $customer->newsletter = 1;

        $customer->active = $request->active;

        $customer->save();

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
        $customer = Customer::find($id);

        $customer->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }

    public function account()
    {
        return view('pages.account');
    }

    
}
