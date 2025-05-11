<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileEdit()
    {
        return view('mypage_profile');
    }
}
