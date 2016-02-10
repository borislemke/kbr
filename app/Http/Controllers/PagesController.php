<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Blog;
use App\Property;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(Request $request)
    {

        $currency = $request->session()->get('currency', 'usd');

        \Config::set('currency', $currency);
    }

    public function home()
    {
        //

        return view('pages.home_old');
    }

    public function about()
    {
        //
        $titles = 'About';
        return view('pages.about', compact('titles'));
    }

    public function contact()
    {
        //
        $titles = 'Contact';
        return view('pages.contact', compact('titles'));
    }

    public function testimony()
    {
        //
        $titles = 'Testimonial';
        $limit = 20;

        $testimonials = \App\Testimony::where('status', 1)->orderBy('created_at', 'desc')->paginate($limit);



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

            return view('pages.testimony', compact('titles', 'testimonials'));
        }

    }

    public function sellProperty()
    {
        //
        $titles = 'Sell Property';
        return view('pages.sell-property', compact('titles'));
    }

    public function lawyerNotary()
    {
        //
        $titles = 'Lawyer & Notary';
        return view('pages.lawyer-notary', compact('titles'));
    }

    public function register()
    {
        //
        if (\Auth::customer()->check()) return redirect('account');

        return view('pages.register');
    }

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw \App::abort(404);
        }

        $customer = \App\Customer::where('confirmation_code', $confirmation_code)->first();

        if ( ! $customer)
        {
            throw \App::abort(404);
        }

        $customer->active = 1;
        $customer->confirmed = 1;
        $customer->confirmation_code = null;
        $customer->save();

        return redirect()->route('login', \Lang::get('url')['login'])->with('alert-success', 'You have successfully verified your account.');;
    }

    public function login()
    {
        //
        if (\Auth::customer()->check()) return redirect('account');

        return view('pages.login');
    }

    public function account()
    {
        //

        return view('pages.account');
    }

    public function accountWishlist()
    {
        //
        $limit = 20;

        $customer = \Auth::customer()->get();

        $wishlists = \App\WishList::where('customer_id', $customer->id)->orderBy('created_at', 'desc')->paginate($limit);

        return view('pages.account-wishlist', compact('wishlists', 'customer'));
    }

    public function accountSetting()
    {
        //

        return view('pages.account-setting');
    }


    public function propertyListing($cat)
    {
        
        $limit = 24;

        foreach(\Lang::get('url') as $k => $v) {

            if ($v == $cat) {
                $route = $k;
                break;
            }
        }

        $category = \App\Category::where('route', $route)->first();

        if ($category) {

            $properties = \App\Property::with(array('propertyFiles' => function($query) {
                    $query->where('type', 'image');
                }))
                ->where('category_id', $category->id)
                ->where('status', 1)
                ->filterCategory($category)
                ->orderBy('updated_at', 'DESC')
                ->paginate($limit);

        } else {

            $properties = \App\Property::with(array('propertyFiles' => function($query) {
                    $query->where('type', 'image');
                }))
                ->where('status', 1)
                ->orderBy('updated_at', 'DESC')->paginate($limit);
        }

        $type = \Lang::get('url')[$route];

        if (\Input::get('page') > 1) {

            $html = '';

            foreach ($properties as $property) {

                $html .= '<div class="col-md-4 list-item">
                            <a href="' . route('property.detail', str_slug($property->lang()->title) . '-' . $property->id) . '">

                                <div class="thumbnail">';

                                    if (count($property->propertyFiles) > 0) {

                                        $html .= '<img src="'. asset('uploads/property/' . $property->propertyFiles[0]->file) .'">';
                                    } else {

                                        $html .= '<img src="'. asset('no-image.png') .'">';
                                    }

                                $html .= '<div class="caption">
                                        <h3 class="list-item-title">'. $property->lang()->title .'</h3>
                                    </div>
                                </div>
                            </a>
                        </div>';

            }
            
            $html .= '<a class="jscroll-next hidden" href="'. $properties->nextPageUrl() .'">next page</a>';

            return $html;

        } else {

            return view('pages.property-listing', compact('properties', 'type'));
        }

    }


    public function propertyView($slug)
    {

        $slug = explode('-', $slug);

        $id = end($slug);

        $property = Property::find($id);

        return view('pages.property-view', compact('property'));
    }


    public function propertySearch($slug)
    {
        $find = \Input::get('find');

        $category = \Input::get('category');

        $price = \Input::get('price');

        if ( $find != 'all' ) {
            $find = explode('-', $find);
            $type = end($find);
            $srctype = $find[ 3 ];
            $titles = ($srctype == '1' || $srctype == '2') ? $find[ 0 ] .' '. $find [ 1 ] .' $'. $find[ 2 ] : $find[ 0 ] .' '. $find [ 1 ] .' '. $find[ 2 ];
        }
        else {
            $type = 'Properties';
            $srctype = '';
            $titles = 'All';
        }

        $property = Property::where('id','<','20')->paginate(10);

        return view('pages.search-property', compact('type', 'titles', 'srctype', 'property'));
    }

    public function lawyerPage()
    {

        return 'LAWYER';
    }


    public function blogListing()
    {
        //
        $blogs = Blog::orderBy('id', 'DESC')->get();
        
        $titles = 'Blog';

        return view('pages.blog-listing', compact('blogs', 'titles'));
    }


    public function blogView($url)
    {
        //
        $blog = Blog::where('url', $url)->first();

        return view('pages.blog-view', ['blog' => $blog]);
    }
}
