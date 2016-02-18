<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    private $admin;

    public function __construct()
    {
        $this->admin = \Auth::user()->get();
    }

    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }
    
    public function properties(Request $request, $term = null)
    {
        if ($request->action == 'create') return view('admin.pages.property.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $property = \App\Property::find($request->id);

            return view('admin.pages.property.edit', compact('property'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.property.index', $request);

        return view('admin.pages.property.listing', compact('api_url'));
    }
    
    public function enquiries(Request $request, $term = null)
    {
        if ($request->action == 'create') return view('admin.pages.enquiry.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $enquiry = \App\Enquiry::find($request->id);

            return view('admin.pages.enquiry.edit', compact('enquiry'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.enquiry.index', $request);

        return view('admin.pages.enquiry.listing', compact('api_url'));
    }
    
    public function customers(Request $request, $term = null)
    {
        if ($term == 'testimonials') return $this->testimonials($request);

        if ($term == 'messages') return $this->messages($request);

        if ($request->action == 'create') return view('admin.pages.customer.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $customer = \App\Customer::find($request->id);

            return view('admin.pages.customer.edit', compact('customer'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.customer.index', $request);

        return view('admin.pages.customer.listing', compact('api_url'));
    }

    public function testimonials(Request $request)
    {

        if ($request->action == 'create') return view('admin.pages.testimony.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $testimony = \App\Testimony::find($request->id);

            return view('admin.pages.testimony.edit', compact('testimony'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.testimony.index', $request);

        return view('admin.pages.testimony.listing', compact('api_url'));
    }

    public function messages(Request $request)
    {

        if ($request->action == 'create') return view('admin.pages.contact.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $contact = \App\Contact::find($request->id);

            return view('admin.pages.contact.edit', compact('contact'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.message.index', $request);

        return view('admin.pages.contact.listing', compact('api_url'));
    }
    
    public function pages(Request $request, $term = null)
    {
        if ($request->action == 'create') return view('admin.pages.page.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $page = \App\Page::find($request->id);

            return view('admin.pages.page.edit', compact('page'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.page.index', $request);

        return view('admin.pages.page.listing', compact('api_url'));
    }
    
    public function posts(Request $request, $term = null)
    {
        if ($request->action == 'create') return view('admin.pages.post.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $post = \App\Post::find($request->id);

            return view('admin.pages.post.edit', compact('post'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.post.index', $request);

        return view('admin.pages.post.listing', compact('api_url'));
    }

    public function branches(Request $request)
    {

        if ($request->action == 'create') return view('admin.pages.branch.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $branch = \App\branch::find($request->id);

            return view('admin.pages.branch.edit', compact('branch'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.branch.index', $request);

        return view('admin.pages.branch.listing', compact('api_url'));
    }

    public function my_account(Request $request)
    {
        $user = $this->admin;

        return view('admin.pages.user.my-account', compact('user'));
    }

    public function accounts(Request $request)
    {

        if ($request->action == 'create') return view('admin.pages.user.create');

        if ($request->action == 'edit' && isset($request->id)) {

            $user = \App\User::find($request->id);

            return view('admin.pages.user.edit', compact('user'));
        }

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.user.index', $request);

        return view('admin.pages.user.listing', compact('api_url'));
    }

    public function settings()
    {
        $autoCurrency = file_exists(storage_path('config/autocurrency.flag'));

        return view('admin.pages.settings', ['autoCurrency' => $autoCurrency]);
    }
    public function currency() {

        return view('admin.pages.currency');

    }

    public function notifications() {

        return view('admin.pages.notifications');

    }

    public function io() {

        return view('admin.pages.io');

    }

    public function about() {

        return view('admin.pages.about');

    }

}
