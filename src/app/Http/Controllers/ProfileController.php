<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function profileEdit()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;

        $user = Auth::user();
        $user_profile = $user->profile;
        if ($user_profile != null) {
            $profile_id = $user_profile->id;
            $image = $user_profile->image;
            $post_code = $user_profile->post_code;
            $address = $user_profile->address;
            $building = $user_profile->building;
        } else {
            $profile_id = null;
            $image = null;
            $post_code = null;
            $address = null;
            $building = null;
        }

        return view('mypage_profile', compact('user_id', 'user_name', 'profile_id', 'image', 'post_code', 'address', 'building'));
    }

    public function profileUpdate(Request $request)
    {
        $file_name = $request->file('profile_image')->getClientOriginalName();
        $request->file('profile_image')->storeAs('public/images', $file_name);

        User::find($request->user_id)->update(['name' => $request->user_name]);

        $user = Auth::user();
        $user_profile = $user->profile;
        if ($user_profile == null) {
            Profile::create([
                'user_id' => $request->user_id,
                'image' => 'storage/images/' . $file_name,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        } else {
            Profile::find($request->profile_id)->update([
                'image' => 'storage/images/' . $file_name,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        }

        return redirect('/');
    }

    public function profile(Request $request)
    {
        $param = $request->page;
        return view('mypage', compact('param'));
    }
}
