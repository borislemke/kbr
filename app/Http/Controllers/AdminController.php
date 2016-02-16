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

        $request = json_encode($request->all());

        $request = json_decode($request, true);

        $api_url = route('api.enquiry.index', $request);

        return view('admin.pages.enquiry.listing', compact('api_url'));
    }
    
    public function customers($term = null)
    {
        return view('admin.pages.customers');
    }
    
    public function pages($term = null)
    {
        return view('admin.pages.pages');
    }
    
    public function posts($term = null)
    {
        return view('admin.pages.posts');
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
