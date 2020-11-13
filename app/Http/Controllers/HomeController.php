<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserData;
use Auth;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $id = Auth::user()->id;
        $users = User::paginate(5);

        $userdata = new UserData;
        $user = new User;
        $fio = $userdata->getFioUser($id);
        $name = $userdata->name;



        return view('home', ['users' => $users, 'fio' => $fio, 'name' => $name, 'userdata' => $userdata]);
    }
}
