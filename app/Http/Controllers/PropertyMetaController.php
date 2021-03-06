<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PropertyMeta;

class PropertyMetaController extends Controller
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
        $propertyMeta = new PropertyMeta;

        $propertyMeta->property_id = $request->property_id;
        $propertyMeta->name = $request->name;
        $propertyMeta->value = $request->value;
        $propertyMeta->type = $request->type;

        $propertyMeta->save();

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

    public function thumb(Request $request)
    {
        //
        $thumb = PropertyMeta::where('property_id', $request->property_id)
            ->where('type', 'thumbnail')->first();

        if ($thumb)
            $thumb->delete();

        $propertyMeta = new PropertyMeta;

        $propertyMeta->property_id = $request->property_id;
        $propertyMeta->name = 'thumbnail';
        $propertyMeta->value = $request->value;
        $propertyMeta->type = 'thumbnail';

        $propertyMeta->save();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'success', 'message' => 'object has been saved')));
    }

}
