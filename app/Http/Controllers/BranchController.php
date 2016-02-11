<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Branch;

class BranchController extends Controller
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
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'city' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        if ($request->edit != 0) return $this->update($request, $request->edit);

        $branch = new Branch;

        $branch->name = $request->name;

        $city = \App\City::where('city_name', $request->city)->first();

        $branch->city = $request->city;
        $branch->province = $city->province->province_name;
        $branch->country = $city->province->country->nicename;

        $branch->manager = $request->manager;

        $branch->save();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'post success', 'message' => 'Branch has been saved')));

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
        $branch = Branch::find($id);

        return $branch;
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
        $branch = Branch::find($id);

        $branch->name = $request->name;

        $city = \App\City::where('city_name', $request->city)->first();

        $branch->city = $request->city;
        $branch->province = $city->province->province_name;
        $branch->country = $city->province->country->nicename;

        $branch->manager = $request->manager;

        $branch->save();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'post success', 'message' => 'Branch has been updated')));
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
        $branch = Branch::find($id);

        $branch->delete();

        // return redirect()->back();
        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'Branch has been deleted'), 'id' => $id));
    }

}
