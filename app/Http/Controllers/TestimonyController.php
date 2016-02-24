<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Testimony;

class TestimonyController extends Controller
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
        $testimonials = new Testimony;

        $testimonials = $testimonials->select('testimonials.*')
            ->join('customers', 'customers.id', '=', 'testimonials.customer_id');

        // with user
        $testimonials = $testimonials->with('customer');

        // searching
        if ($search) {

            $testimonials = $testimonials->where(function ($q) use ($search) {
                    $q->where('testimonials.title', 'like', $search . '%')
                        ->orWhere('testimonials.content', 'like', $search . '%');
                });
        }

        // total records
        $count = $testimonials->count();

        // pagination
        $testimonials = $testimonials->take($length)->skip($start);

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            if ($column == 'customer.username') {

                $testimonials = $testimonials->orderBy('customers.username', $sort);
            } else {

                $testimonials = $testimonials->orderBy('testimonials.' . $column, $sort);
            }            

        } else {

            $testimonials = $testimonials->orderBy('testimonials.' . $column, $sort);
        }

        // get data
        $testimonials = $testimonials->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $testimonials

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

        $testimony = new Testimony;

        $testimony->customer_id = $request->customer_id;
        $testimony->title = $request->title;
        $testimony->content = $request->content;
        $testimony->status = ($request->status) ? $request->status : 0;

        $testimony->save();

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

        $testimony = Testimony::find($id);

        $testimony->customer_id = $request->customer_id;
        $testimony->title = $request->title;
        $testimony->content = $request->content;
        $testimony->status = $request->status;

        $testimony->save();

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
        $testimony = Testimony::find($id);

        $testimony->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }
}
