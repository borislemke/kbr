<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Enquiry;

use Mail;

class EnquiryController extends Controller
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
        $enquiries = new Enquiry;

        $enquiries = $enquiries->select('enquiries.*')
            ->join('properties', 'properties.id', '=', 'enquiries.property_id')
            ->join('property_locales', 'property_locales.property_id', '=', 'properties.id')
            ->leftJoin('property_terms', 'property_terms.property_id', '=', 'properties.id')
            ->leftJoin('terms', 'property_terms.term_id', '=', 'terms.id');

        // with property
        $enquiries = $enquiries->with(['property' => function ($q) {

            // locale
            $q->with(['propertyLocales' => function ($q) {
                $q->where('locale', 'en');

            // category
            }])->with(['terms' => function ($q) {
                $q->where('type', 'property_category');

            // image
            }])
            ->with('thumb')
            ->with('user');

        }]);

        // searching
        if ($search) {

            $enquiries = $enquiries->where('property_locales.locale', 'en')
                ->where(function ($q) use ($search) {
                    $q->where('property_locales.title', 'like', $search . '%')
                        ->orWhere('enquiries.subject', 'like', $search . '%');
                });
        }

        // access
        $enquiries = $enquiries->access();

        // total records
        $count = $enquiries->count();

        // pagination
        $enquiries = $enquiries->take($length)->skip($start);

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            if ($column == 'property.property_locales.0.title') {

                $enquiries = $enquiries->orderBy('property_locales.title', $sort);
            } else if ($column == 'property.terms.0.name') {

                $enquiries = $enquiries->orderBy('terms.name', $sort);
            } else {

                $enquiries = $enquiries->orderBy('enquiries.' . $column, $sort);
            }

        } else {

            $enquiries = $enquiries->orderBy('enquiries.' . $column, $sort);
        }

        // get data
        $enquiries = $enquiries->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $enquiries

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
            'name' => 'required',
            'subject' => 'required',
            'phone' => 'required',
            'g-recaptcha-response' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => $validator->errors() )));
        }

        $enquiry = new Enquiry;

        $enquiry->property_id = $request->property_id;
        // $enquiry->customer_id = $request->customer_id;
        $enquiry->subject = $request->subject;
        $enquiry->content = $request->content;

        if ($request->name) {
            $name = explode(' ', $request->name);
            $enquiry->firstname = $name[0];

            if (count($name) > 1)
                $enquiry->lastname = $name[1];

        } else {            
            $enquiry->firstname = $request->firstname;
            $enquiry->lastname = $request->lastname;
        }

        $enquiry->phone = $request->phone;
        $enquiry->email = $request->email;

        $enquiry->save();

        $this->email($enquiry);

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
        $enquiry = Enquiry::find($id);

        $enquiry->property_id = $request->property_id;
        // $enquiry->customer_id = $request->customer_id;
        $enquiry->subject = $request->subject;
        $enquiry->content = $request->content;
        $enquiry->firstname = $request->firstname;
        $enquiry->lastname = $request->lastname;
        $enquiry->phone = $request->phone;
        $enquiry->email = $request->email;

        $enquiry->save();
        
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
        $enquiry = Enquiry::find($id);

        $enquiry->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }

    public function email($enquiry)
    {

        // $email = $enquiry->property->user->email;
        $email = 'gusman@kesato.com';

        Mail::send('emails.enquiry', ['enquiry' => $enquiry], function($message) use ($email) {

            $message->from('boris@kesato.com', 'Kibarer');

            $message->to($email, $email)->subject('Enquiry Kibarer');
        });

        return true;
    }
}
