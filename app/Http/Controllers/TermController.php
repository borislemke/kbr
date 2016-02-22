<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Term;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        // datatable parameter
        $draw = $request->draw;
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];

        // sorting
        $column = 'id';
        $sort = $request->order[0]['dir'] ? $request->order[0]['dir'] : 'desc'; //asc

        // new object
        $terms = new Term;

        if ($request->type == 'post_category') {

            $terms = $terms->where('terms.type', 'post_category');
        }

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            $terms = $terms->orderBy('terms.' . $column, $sort);

        } else {

            $terms = $terms->orderBy('terms.' . $column, $sort);
        }

        // total records
        $count = $terms->count();

        // get data
        $terms = $terms->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $terms

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
            'slug' => 'required|unique:terms,slug'
            ]);

        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        $term = new Term;

        $term->name = $request->name;
        $term->slug = $request->slug;
        $term->route = str_replace('-', '_', $request->slug);
        $term->parent_id = $request->parent_id;
        $term->type = $request->type;
        $term->order = 0;

        $term->save();

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

        $term = Term::find($id);

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:terms,slug,'. $term->id
            ]);

        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        $term->name = $request->name;
        $term->slug = $request->slug;
        $term->route = str_replace('-', '_', $request->slug);
        $term->parent_id = $request->parent_id;
        $term->type = $request->type;
        $term->order = 0;

        $term->save();

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

        $term = Term::find($id);

        if ($term->slug == 'uncategorized') {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => 'it is not allowed to delete this item') ));
        }

        $term->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }
}
