<?php

namespace App\Http\Controllers;

use App\VoucherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $voucherRequests = DB::table('voucher_requests')->where('email', $user->email)->get();
        return view('home', ['voucherRequests'=>$voucherRequests]);
    }

    public function admin()
    {
        $users = DB::table('users')
            ->where('admin', false)
            ->get();
        return view('admin')->with('users', $users);
    }
}
