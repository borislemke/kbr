<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Property;

class PropertyController extends Controller
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
        $properties = new Property;

        // with user
        $properties = $properties->with('user');

        // with locale
        $properties = $properties->with(['propertyLocales' => function ($q) {
            $q->where('locale', 'en');
        }]);

        // with image
        $properties = $properties->with(['attachments' => function ($q) {
            $q->where('type', 'img');
        }]);

        // searching
        if ($search) {            

            $properties = $properties->select('properties.*')
                ->join('property_locales', 'property_locales.property_id', '=', 'properties.id')
                ->where('property_locales.locale', 'en')
                ->where('property_locales.title', 'like', $search . '%');
        }

        $properties = $properties->orderBy('properties.' . $column, $sort);

        // villa or land, ..
        if ($category) {

            $properties = $properties->select('properties.*')
                ->join('property_terms', 'property_terms.property_id', '=', 'properties.id')
                ->join('terms', 'terms.id', '=', 'property_terms.term_id')
                ->where('terms.slug', $category);
        }

        // availbale, un ,...
        if ($status) {

            $properties = $properties->where('properties.status', statusToInteger($status));
        }

        // total records
        $count = $properties->count();

        // pagination
        $properties = $properties->take($length)->skip($start);

        // get data
        $properties = $properties->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $properties

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
    }

    public function search(Request $request, $page, $category = null)
    {
        $limit = 24;

        $properties = new Property;

        $properties = $properties->select('properties.*');

        // filter category
        if ($category != null) {
            $properties = $properties->join('property_terms', 'property_terms.property_id', '=', 'properties.id')
                ->join('terms', 'terms.id', '=', 'property_terms.term_id')
                ->where('terms.slug', $category);
        }

        $properties = $properties->paginate($limit);


        return view('pages.search-property', compact('properties'));
    }

}
