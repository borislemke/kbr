<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Contact;

use Mail;

class ContactController extends Controller
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
        $contacts = new Contact;

        // searching
        if ($search) {

            $contacts = $contacts->where(function ($q) use ($search) {
                    $q->where('contacts.email', 'like', $search . '%')
                        ->orWhere('contacts.message', 'like', $search . '%');
                });
        }

        // total records
        $count = $contacts->count();

        // pagination
        $contacts = $contacts->take($length)->skip($start);

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            $contacts = $contacts->orderBy('contacts.' . $column, $sort);

        } else {

            $contacts = $contacts->orderBy('contacts.' . $column, $sort);
        }

        // get data
        $contacts = $contacts->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $contacts

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
            'email' => 'email|required',
            'g-recaptcha-response' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => $validator->errors() )));
        }

        $contact = new Contact;

        $contact->firstname = $request->firstname;
        $contact->lastname = $request->lastname;
        $contact->email = $request->email;
        $contact->message = $request->message;

        $contact->save();

        $this->email($contact);

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'success', 'message' => 'success')));
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
        $contact = Contact::find($id);

        $contact->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }

    public function email($contact)
    {
        $email = \Config::get('mail.contact');

        Mail::send('emails.contact', ['contact' => $contact], function($message) use ($email) {

            $message->from('boris@kesato.com', 'Kibarer');

            $message->to($email, $email)->subject('Contact Kibarer');
        });

        return true;
    }

}
