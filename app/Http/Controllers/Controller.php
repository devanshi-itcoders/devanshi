<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            self::__setMasterFilterSession($request);
            return $next($request);
        });
    }

    public function __setMasterFilterSession(Request $request ) {
        if($request->query('year')) {
            // set user session variable with year
            //  $data=Session::set('input_field', 'field_value');
            //   dd($data);
            $master_filter=$request->get('year');
            // dd($master_filter);
            // Session::put('master_filter', $master_filter);
            // Session::get('master_filter');
            $request->session()->put('master_filter', $master_filter);
            // $value = $request->session()->get('master_filter');
            // dd(auth()->user());
            // $this->setUserSession($user);
            // if(Auth::user()) {
            //     dd(Auth::user());
            // }
            // dd($request->query('year'));

        }
    }



}
