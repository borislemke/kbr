<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Page;

use DB;

class PageController extends Controller
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
        $pages = new Page;

        $pages = $pages->select('pages.*')

            ->join('page_locales', 'page_locales.page_id', '=', 'pages.id')
            ->where('page_locales.locale', 'en');

        $pages = $pages->with(['pageLocales' => function ($q) {

            $q->where('locale', 'en');
        }]);

        // searching
        if ($search) {

            $pages = $pages->where(function ($q) use ($search) {

                $q->where('page_locales.title', 'like', $search . '%');
            });
        }

        // total records
        $count = $pages->count();

        // pagination
        $pages = $pages->take($length)->skip($start);

        // order
        if ($request->order[0]['column']) {

            $column = $request->columns[$request->order[0]['column']]['data'];

            if ($column == 'page_locales.0.title') {

                $pages = $pages->orderBy('page_locales.title', $sort);
            } else {

                $pages = $pages->orderBy('pages.' . $column, $sort);
            }

        } else {

            $pages = $pages->orderBy('pages.' . $column, $sort);
        }

        // get data
        $pages = $pages->get();

        // datatable response
        $respose = [
                "draw" => $draw,
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $pages

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

        $page = new Page;

        $page->user_id = \Auth::user()->get()->id;
        $page->slug = $request->slug['en'];
        $page->route = str_replace('-', '_', $request->slug['en']);
        $page->status = $request->status;

        $page->save();

        // locale
        foreach ($request->title as $key => $value) {

            $locale = new \App\PageLocale;

            $locale->page_id = $page->id;
            $locale->title = $request->title[$key];
            $locale->content = $request->content[$key];
            $locale->meta_keyword = $request->meta_keyword[$key];
            $locale->meta_description = $request->meta_description[$key];
            $locale->slug = $request->slug[$key];
            $locale->locale = $key;

            $locale->save();

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
        $validator = \Validator::make($request->all(), [
            'title' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => implode($validator->errors()->all(), '<br>') )));
        }

        DB::beginTransaction();

        $page = Page::find($id);

        $page->user_id = \Auth::user()->get()->id;
        $page->slug = $request->slug['en'];
        $page->route = str_replace('-', '_', $request->slug['en']);
        $page->status = $request->status;

        $page->save();

        // delete first
        $page->pageLocales()->delete();

        // locale
        foreach ($request->title as $key => $value) {

            $locale = new \App\PageLocale;

            $locale->page_id = $page->id;
            $locale->title = $request->title[$key];
            $locale->content = $request->content[$key];
            $locale->meta_keyword = $request->meta_keyword[$key];
            $locale->meta_description = $request->meta_description[$key];
            $locale->slug = $request->slug[$key];
            $locale->locale = $key;

            $locale->save();

        }

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
        $page = Page::find($id);

        if (in_array($page->id, [1, 2, 3])) {
            return response()->json(array('status' => 500, 'monolog' => array('title' => 'errors', 'message' => 'you are not allowed to delete this item') ));
        }

        $page->delete();

        return response()->json(array('status' => 200, 'monolog' => array('title' => 'delete success', 'message' => 'object has been deleted'), 'id' => $id));
    }

    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function testimony()
    {
        $limit = 24;

        $testimonials = new \App\Testimony;

        $testimonials = $testimonials->orderBy('created_at', 'desc');

        $testimonials = $testimonials->where('status', 1);

        $testimonials = $testimonials->paginate($limit);

        if (\Input::get('page') > 1) {

            $html = '';

            foreach ($testimonials as $testimony) {
                $html .= '<div class="well">
                            <h4>'. $testimony->title .'</h4>
                            <p>'. $testimony->content .'</p>
                            <small>--'. $testimony->customer->firstname .' '. $testimony->customer->lastname .'</small>
                        </div>';
            }
            
            $html .= '<a class="jscroll-next hidden" href="'. $testimonials->nextPageUrl() .'">next page</a>';

            return $html;

        } else {

            return view('pages.testimony', compact('testimonials'));
        }

    }

    public function sellProperty()
    {
        return view('pages.sell-property');
    }

    public function lawyerNotary()
    {
        return view('pages.lawyer-notary');
    }

}
