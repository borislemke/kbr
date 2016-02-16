<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Enquiry;

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
            ->join('property_locales', 'property_locales.property_id', '=', 'properties.id');

        // with property
        $enquiries = $enquiries->with(['property' => function ($q) {

            // locale
            $q->with(['propertyLocales' => function ($q) {
                $q->where('locale', 'en');

            // image
            }])->with(['attachments' => function ($q) {
                $q->where('type', 'img');

            // agent
            }])->with('user');

        }]);

        // searching
        if ($search) {

            $enquiries = $enquiries->where('property_locales.locale', 'en')
                ->where(function ($q) use ($search) {
                    $q->where('property_locales.title', 'like', $search . '%')
                        ->orWhere('enquiries.subject', 'like', $search . '%');
                });
        }

        // total records
        $count = $enquiries->count();

        // pagination
        $enquiries = $enquiries->take($length)->skip($start);

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            if ($column == 'property.property_locales.0.title') {

                $enquiries = $enquiries->orderBy('property_locales.title', $sort);
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
        $enquiry = Enquiry::find($id);

        $enquiry->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'Property has been deleted'), 'id' => $id));
    }
}
