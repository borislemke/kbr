<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;

class PostController extends Controller
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
    }

    public function listing($term = null)
    {

        $posts = new Post;

        if ($term != null) {

            $segments = explode('/', $term);

            $slug = end($segments);

            $posts = $posts->join('slug', $slug);

        }

        $posts = $posts->where('status', 1);

        $posts = $posts->get();

        return view('pages.blog-listing', compact('posts'));
    }

    public function detail($page, $term = null)
    {

        if ($term == null) return $this->listing();

        $segments = explode('/', $term);

        $slug = end($segments);

        $post = new Post;

        $post = $post->where('slug', $slug);

        if ($post->count() == 0) return $this->listing($term);


        $post = $post->where('status', 1);

        $post = $post->first();

        return view('pages.blog-view', compact('post'));
    }

}
