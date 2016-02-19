<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\propertyLocale;

use DB;

class PropertyLocaleController extends Controller
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
        DB::beginTransaction();

        foreach ($request->id as $key => $value) {
            
            if ($value == 0) {

                $propertyLocale = new PropertyLocale;
            } else {

                $propertyLocale = PropertyLocale::find($value);
            }

            $propertyLocale->property_id = $request->property_id;
            $propertyLocale->meta_keyword = $request->meta_keyword[$key];
            $propertyLocale->meta_description = $request->meta_description[$key];
            $propertyLocale->title = $request->title[$key];
            $propertyLocale->content = $request->content[$key];
            $propertyLocale->locale = $key;
            $propertyLocale->slug = $request->slug[$key];

            $propertyLocale->save();
        }

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
    }
}
