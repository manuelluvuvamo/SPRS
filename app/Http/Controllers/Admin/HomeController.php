<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
{
    //

    public function __construct()
    {
    }
    public function dash()
    {

       
      
            return view('admin.dashboard');
    }
}