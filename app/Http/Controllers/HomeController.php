<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(Request $request)
    {

        if (!empty(session()->get('master_filter'))) {
            $master_filter = $request->session()->get('master_filter');
        } else {
            $master_filter = date('Y');
        }
        $total_users = User::where('created_at', 'like', '%' . $master_filter . '%')->get()->count();
        $total_roles = Role::where('created_at', 'like', '%' . $master_filter . '%')->get()->count();
        $total_pages = Page::where('created_at', 'like', '%' . $master_filter . '%')->get()->count();
   
        return view('admin.dashboard',compact('total_users','total_roles','total_pages'));
    }
}
