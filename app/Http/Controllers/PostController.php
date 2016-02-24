<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;

use DB;

class PostController extends Controller
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
        $posts = new Post;

        $posts = $posts->select('posts.*')
            ->join('post_locales', 'post_locales.post_id', '=', 'posts.id')
            ->where('post_locales.locale', 'en');

        $posts = $posts->with(['postLocales' => function ($q) {

            $q->where('locale', 'en');
        }])->with('categories');

        // searching
        if ($search) {

            $posts = $posts->where(function ($q) use ($search) {

                $q->where('post_locales.title', 'like', $search . '%');
            });
        }

        $posts = $posts->groupBy('posts.id');

        // total records
        $count = $posts->count();

        // pagination
        $posts = $posts->take($length)->skip($start);

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            if ($column == 'post_locales.0.title') {

                $posts = $posts->orderBy('post_locales.title', $sort);
            } else if ($column == 'categories.0.name') {

                $posts = $posts->join('post_terms', 'post_terms.post_id', '=', 'posts.id')
                    ->join('terms', 'terms.id', '=', 'post_terms.term_id')
                    ->where('terms.type', 'post_category')
                    ->orderBy('terms.name', $sort);
                    
            } else {

                $posts = $posts->orderBy('posts.' . $column, $sort);
            }

        } else {

            $posts = $posts->orderBy('posts.' . $column, $sort);
        }

        // get data
        $posts = $posts->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $posts

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
            'title' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        DB::beginTransaction();

        $post = new Post;

        $post->user_id = \Auth::user()->get()->id;
        $post->slug = $request->slug['en'];
        $post->route = str_replace('-', '_', $request->slug['en']);
        $post->status = $request->status;

        $post->save();

        // locale
        foreach ($request->title as $key => $value) {

            $locale = new \App\postLocale;

            $locale->post_id = $post->id;
            $locale->title = $request->title[$key];
            $locale->content = $request->content[$key];
            $locale->meta_keyword = $request->meta_keyword[$key];
            $locale->meta_description = $request->meta_description[$key];
            $locale->slug = $locale->slug($request->slug[$key], $post->id);
            $locale->locale = $key;

            $locale->save();

        }

        // category
        $postTerm = new \App\PostTerm;

        $postTerm->term_id = $request->term_id;
        $postTerm->post_id = $post->id;

        $postTerm->save();

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
        $validator = \Validator::make($request->all(), [
            'title' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        DB::beginTransaction();

        $post = Post::find($id);

        $post->user_id = \Auth::user()->get()->id;
        $post->slug = $request->slug['en'];
        $post->route = str_replace('-', '_', $request->slug['en']);
        $post->status = $request->status;

        $post->save();

        // delete first
        $post->postLocales()->delete();

        // locale
        foreach ($request->title as $key => $value) {

            $locale = new \App\postLocale;

            $locale->post_id = $post->id;
            $locale->title = $request->title[$key];
            $locale->content = $request->content[$key];
            $locale->meta_keyword = $request->meta_keyword[$key];
            $locale->meta_description = $request->meta_description[$key];
            $locale->slug = $locale->slug($request->slug[$key], $post->id);
            $locale->locale = $key;

            $locale->save();

        }

        // category
        $term = $post->terms()->where('type', 'post_category')->first();

        $postTerm = \App\PostTerm::where('post_id', $post->id)
            ->where('term_id', $term->id)
            ->first();

        $postTerm->term_id = $request->term_id;
        $postTerm->post_id = $post->id;

        $postTerm->save();

        DB::commit();

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
        $post = Post::find($id);

        $post->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }

    public function listing($term = null)
    {
        $limit = 3;

        $posts = new Post;

        if ($term != null) {

            $segments = explode('/', $term);

            $slug = end($segments);

            $posts = $posts->join('slug', $slug);

        }

        $posts = $posts->where('status', 1);

        $posts = $posts->orderBy('posts.created_at', 'desc');

        $posts = $posts->paginate($limit);

        return view('pages.blog-listing', compact('posts'));
    }

    public function detail($post, $term = null)
    {

        if ($term == null) return $this->listing();

        $segments = explode('/', $term);

        $slug = end($segments);

        $post = new Post;

        $post = $post->whereHas('postLocales', function ($q) use ($slug) {
            $q->where('slug', $slug);
        });

        if ($post->count() == 0) return abort('404');


        $post = $post->where('status', 1);

        $post = $post->first();

        // return $post;

        return view('pages.blog-view', compact('post'));
    }

}
