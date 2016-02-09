<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Inquiry;

use DB;

class InquiryController extends Controller
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
            'subject' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        DB::beginTransaction();

        $inquiry = new Inquiry;

        $inquiry->property_id = $request->property_id;
        $inquiry->customer_id = $request->customer_id;
        $inquiry->subject = $request->subject;
        $inquiry->content = $request->content;
        $inquiry->firstname = $request->firstname;
        $inquiry->lastname = $request->lastname;
        $inquiry->phone = $request->phone;
        $inquiry->email = $request->email;

        $inquiry->save();

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
        $inquiry = Inquiry::find($id);

        return $inquiry;
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
            'subject' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        DB::beginTransaction();

        $inquiry = Inquiry::find($id);

        // $inquiry->property_id = $request->property_id;
        // $inquiry->customer_id = $request->customer_id;
        $inquiry->subject = $request->subject;
        $inquiry->content = $request->content;
        $inquiry->firstname = $request->firstname;
        $inquiry->lastname = $request->lastname;
        $inquiry->phone = $request->phone;
        $inquiry->email = $request->email;

        $inquiry->save();

        DB::commit();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'update success', 'message' => 'Inquiry has been updated')));
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
        $inquiry = Inquiry::find($id);

        $inquiry->delete();

        // return redirect()->back();
        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'Inquiry has been deleted'), 'id' => $id));
    }

    public function postInquiry(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'subject' => 'required'
        ]);

        $name = explode(' ', $request->name);

        DB::beginTransaction();

        $inquiry = new Inquiry;

        $inquiry->property_id = $request->property_id;
        // $inquiry->customer_id = $request->customer_id;
        $inquiry->subject = $request->subject;
        $inquiry->content = $request->content;
        $inquiry->firstname = $name[0];

        if (count($name) > 1) $inquiry->lastname = $name[1];

        $inquiry->phone = $request->phone;
        $inquiry->email = $request->email;

        $inquiry->save();

        DB::commit();

        $request->session()->flash('alert-success', 'Thanks. We will check your enquiry soon.');

        return redirect()->back();

    }


}
