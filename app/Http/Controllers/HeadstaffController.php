<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HeadstaffController extends Controller
{
    //
    public function index()
    {
        //prosess pemanggilan file blade
        return view('headstaff.dashboard');
    }

    public function userIndex()
    {
        //prosess pemanggilan file blade
        $users = User::all();
        return view('headstaff.user.index', compact('users'));
    }
}
