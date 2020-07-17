<?php

namespace App\Http\Controllers;

use App\RealEstate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCount = User::count();
        $estatesCount = RealEstate::count();
        return view('admin.dashboard', compact('estatesCount', 'userCount'));
    }
}
