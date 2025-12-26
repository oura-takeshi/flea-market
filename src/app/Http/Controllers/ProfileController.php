<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;

class ProfileController extends Controller
{
    public function profileEdit()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $user_name = $user->name;

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

    public function profileUpdate(ProfileRequest $request)
    {
        $data = $request->file('profile_image');
        if ($data != null) {
            $file_name = $request->file('profile_image')->getClientOriginalName();
            $request->file('profile_image')->storeAs('public/images', $file_name);
        }

        User::find($request->user_id)->update(['name' => $request->user_name]);

        $user = Auth::user();
        $user_profile = $user->profile;
        if ($user_profile == null) {
            if ($data != null) {
                Profile::create([
                    'user_id' => Auth::id(),
                    'image' => 'storage/images/' . $file_name,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'building' => $request->building,
                ]);
            } else {
                Profile::create([
                    'user_id' => Auth::id(),
                    'image' => null,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'building' => $request->building,
                ]);
            }
        } else {
            if ($data != null) {
                Profile::find($request->profile_id)->update([
                    'image' => 'storage/images/' . $file_name,
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'building' => $request->building,
                ]);
            } else {
                Profile::find($request->profile_id)->update([
                    'post_code' => $request->post_code,
                    'address' => $request->address,
                    'building' => $request->building,
                ]);
            }
        }

        return redirect('/');
    }

    public function profile(Request $request)
    {
        $param = $request->page;

        $user = Auth::user();
        $user_id = Auth::user()->id;
        $user_name = $user->name;

        $user_profile = $user->profile;
        if ($user_profile == null) {
            $image = null;
        } else {
            $image = $user_profile->image;
        }

        $items = Item::all();

        $active_items = $user->activeItems()->get();

        $active_chats = $user->activeChatsWithUnreadCount()->get();

        $total_unread_count = $active_chats->sum('unread_count');

        return view('mypage', compact('param', 'user_id', 'user_name', 'image', 'items', 'active_chats', 'total_unread_count'));
    }

    public function addressEdit($item_id)
    {
        $user = Auth::user();
        $user_profile = $user->profile;
        if ($user_profile != null) {
            $profile_id = $user_profile->id;
            $post_code = $user_profile->post_code;
            $address = $user_profile->address;
            $building = $user_profile->building;
        } else {
            $profile_id = null;
            $post_code = null;
            $address = null;
            $building = null;
        }
        return view('purchase_address', compact('user', 'profile_id', 'post_code', 'address', 'building'));
    }

    public function addressUpdate(AddressRequest $request)
    {
        $profile_id = $request->profile_id;
        if ($profile_id == null) {
            Profile::create([
                'user_id' => Auth::id(),
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        } else {
            Profile::find($request->profile_id)->update([
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        }
        return redirect('/');
    }
}
