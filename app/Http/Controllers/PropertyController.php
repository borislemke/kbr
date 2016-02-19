<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Property;

use Mail;
use DB;

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

        // access
        $properties = $properties->access();

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
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'city' =>'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        DB::beginTransaction();

        $user_id = \Auth::user()->get()->id;

        $property = new Property;

        $property->user_id = $user_id;

        // $property->customer_id = $request->customer_id;
        // $property->category_id = $request->category_id;

        $property->currency = $request->currency;
        $property->price = $request->price;
        $property->price_label = $request->price_label;
        $property->type = $request->type;

        $property->building_size = $request->building_size;
        $property->land_size = $request->land_size;

        $property->code = $request->code;
        $property->status = $request->status;
        $property->year = $request->year;

        $property->map_latitude = $request->map_latitude;
        $property->map_longitude = $request->map_longitude;

        $property->view_north = $request->view_north;
        $property->view_east = $request->view_east;
        $property->view_west = $request->view_west;
        $property->view_south = $request->view_south;

        $property->is_price_request = $request->is_price_request;
        $property->is_exclusive = $request->is_exclusive;

        $property->owner_name = $request->owner_name;
        $property->owner_email = $request->owner_email;
        $property->owner_phone = $request->owner_phone;

        $property->agent_commission = $request->agent_commission;
        $property->agent_contact = $request->agent_contact;
        $property->agent_meet_date = $request->agent_meet_date;
        $property->agent_inspector = $request->agent_inspector;

        $property->sell_reason = $request->sell_reason;
        $property->sell_note = $request->sell_note;
        $property->other_agent = $request->other_agent;

        $property->orientation = $request->orientation;
        $property->sell_in_furnish = $request->sell_in_furnish;
        $property->lease_period = $request->lease_period;
        $property->lease_year = $request->lease_year;
        
        
        // find province, country
        $city = \App\City::where('city_name', $request->city)->first();

        $property->city = $request->city;
        $property->province = $city->province->province_name;
        $property->country = $city->province->country->nicename;

        $property->save();


        // Model::unguard();

        // category
        $propertyTerm = new \App\PropertyTerm;
        $propertyTerm->term_id = $request->category;
        $propertyTerm->property_id = $property->id;

        $propertyTerm->save();

        // locale
        $propertyLocale = new \App\PropertyLocale;

        $propertyLocale->locale = 'en';
        $propertyLocale->title = $request->title;
        $propertyLocale->content = $request->content;
        $propertyLocale->slug = $request->slug;
        $propertyLocale->property_id = $property->id;

        $propertyLocale->save();

        // distances
        if ($request->distance_name) {
            foreach ($request->distance_name as $key => $value) {

                $propertyMeta = new \App\PropertyMeta;

                $propertyMeta->name = $value;
                $propertyMeta->value = $request->distance_value[$key];
                $propertyMeta->type = 'distance';
                $propertyMeta->property_id = $property->id;

                $propertyMeta->save();
            }
        }

        // documents
        if ($request->document_name) {
            foreach ($request->document_name as $key => $value) {

                $propertyMeta = new \App\PropertyMeta;

                $propertyMeta->name = $value;
                $propertyMeta->value = 'ready';
                $propertyMeta->type = 'document';
                $propertyMeta->property_id = $property->id;

                $propertyMeta->save();
            }
        }

        // facilities
        if ($request->facility_name) {
            foreach ($request->facility_name as $key => $value) {

                $propertyMeta = new \App\PropertyMeta;

                $propertyMeta->name = $value;
                $propertyMeta->value = $request->facility_value[$key];
                $propertyMeta->type = 'facility';
                $propertyMeta->property_id = $property->id;

                $propertyMeta->save();
            }
        }

        // files
        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $key => $value) {

                $destinationPath = 'uploads/property';

                $extension = $value->getClientOriginalExtension();
                $fileName = date('YmdHis') . '_' . $key . '_kibarer_property' . '.' . $extension;

                $value->move($destinationPath, $fileName);

                $attachment = new \App\Attachment;

                $attachment->object_id = $property->id;
                $attachment->name = 'property';
                $attachment->file = $fileName;
                $attachment->type = 'img';

                $attachment->save();

            }

        }

        // Model::reguard();

        DB::commit();


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
        $property = Property::find($id);

        $property->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }

    public function delete($id)
    {
        //
        $property = Property::find($id);

        $property->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }

    public function search(Request $request, $page, $term = null)
    {
        $limit = 24;

        $properties = new Property;

        $properties = $properties->select('properties.*');

        // filter category
        if ($term != null) {

            $segment = explode('/', $term);

            $category = end($segment);

            // $segment = 
            $properties = $properties->join('property_terms', 'property_terms.property_id', '=', 'properties.id')
                ->join('terms', 'terms.id', '=', 'property_terms.term_id')
                ->where('terms.slug', $category);
        }

        $properties = $properties->paginate($limit);


        return view('pages.search-property', compact('properties', 'term'));
    }

    public function detail(Request $request, $page, $term = null)
    {
        if ($term == null) return $this->search($request, $page, $term);

        $segment = explode('/', $term);

        $slug = end($segment);

        // $slug = str_replace('.asp', '', $slug);

        $property = new Property;

        $property = $property->where('slug', $slug);

        if ($property->count() == 0) return $this->search($request, $page, $term);

        $property = $property->first();

        return view('pages.property-view', compact('property'));
    }

    public function sellProperty(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'owner_name' => 'required',
            'owner_phone' => 'required',
            'city' => 'required',
            'g-recaptcha-response' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => $validator->errors() )));
        }

        DB::beginTransaction();

        $property = new Property;

        $property->map_latitude = $request->map_latitude;
        $property->map_longitude = $request->map_longitude;
        $property->owner_name = $request->owner_name;
        $property->owner_email = $request->owner_email;
        $property->owner_phone = $request->owner_phone;
        $property->sell_note = $request->sell_note;


        // find province, country
        $city = \App\City::where('city_name', $request->city)->first();

        $property->city = $request->city;
        $property->province = $city->province->province_name;
        $property->country = $city->province->country->nicename;


        //moderation
        $property->status = -2;

        $property->save();

        // category

        $propertyTerm = new \App\PropertyTerm;

        $propertyTerm->term_id = $request->category;
        $propertyTerm->property_id = $property->id;

        $propertyTerm->save();

        $this->email($property);

        DB::commit();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'success', 'message' => 'Thanks. Your property has been sent successfully.')));
    }

    public function email($property)
    {
        $email = 'gusman@kesato.com';

        Mail::send('emails.property-listing', ['property' => $property], function($message) use ($email) {

            $message->from('boris@kesato.com', 'Kibarer');

            $message->to($email, $email)->subject('Listing Request Kibarer');
        });

        return true;
    }

}