<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Attachment;

class AttachmentController extends Controller
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
        $attachment = Attachment::find($id);

        if ($attachment->file) {

            if (\Input::get('name'))
                \File::delete('uploads/' . \Input::get('name') . '/' . $attachment->file);

            else
                \File::delete('uploads/property/' . $attachment->file);
        }

        $attachment->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }

    public function getImage()
    {
        $attachments = new Attachment;

        $attachments = $attachments->where('type', 'img')
            ->where('name', '!=', 'property')
            ->orderBy('created_at', 'desc')
            ->get();

        $responses = array();
        foreach ($attachments as $key => $value) {

            $row = [
                'thumb' => asset('uploads/images/' . $value->name . '/' . $value->file),
                'image' => asset('uploads/images/' . $value->name . '/'. $value->file),
                'title' => 'image title',
                'folder' => $value->name
            ];

            $responses[] = $row;
        }

        return $responses;
    }

    public function uploadImage(Request $request)
    {
        $dir = 'uploads/images/' . $request->name;

        $file = $request->file('file');
         
        $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
         
        if ($_FILES['file']['type'] == 'image/png' 
        || $_FILES['file']['type'] == 'image/jpg' 
        || $_FILES['file']['type'] == 'image/gif' 
        || $_FILES['file']['type'] == 'image/jpeg'
        || $_FILES['file']['type'] == 'image/pjpeg')
        {   
            // setting file's mysterious name
            $filename = md5(date('YmdHis')).'.jpg';

            $file->move($dir, $filename);

            $attachment = new Attachment;

            $attachment->name = $request->name;
            $attachment->file = $filename;
            $attachment->type = 'img';

            $attachment->save();

            // displaying file    
            $array = array(
                'filelink' => asset('uploads/images/'. $request->name . '/' .$filename)
            );
            
            echo stripslashes(json_encode($array));
            
        }
    }

    public function uploadFile(Request $request)
    {

        // copy($_FILES['file']['tmp_name'], '/files/'.$_FILES['file']['name']);

        $file = $request->file('file');

        $file->move('uploads/files/' . $request->name, $_FILES['file']['name']);
                            
        $array = array(
            'filelink' => asset('uploads/files/'. $request->name . '/' . $_FILES['file']['name']),
            'filename' => $_FILES['file']['name']
        );        

        $attachment = new Attachment;

        $attachment->name = $request->name;
        $attachment->file = $_FILES['file']['name'];
        $attachment->type = 'pdf';

        $attachment->save();

        echo stripslashes(json_encode($array));

    }


}
