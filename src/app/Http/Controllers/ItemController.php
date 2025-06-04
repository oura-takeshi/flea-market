<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Like;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $param = $request->page;
        $user_id = Auth::id();
        $not_have_items = Item::where('user_id', '!=', $user_id)->get();
        $like_items = Item::whereHas('likes', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();
        return view('index', compact('param', 'not_have_items', 'like_items'));
    }

    public function detail($item_id)
    {
        $item = Item::find($item_id);
        $item_categories = $item->categories;

        $item_comments = Comment::with('user:id,name')->where('item_id', $item_id)->get();
        foreach ($item_comments as $comment) {
            $comment_user_profile = $comment->user->profile;
            if ($comment_user_profile != null) {
                $image = $comment_user_profile->image;
            } else {
                $image = null;
            }
            $comment["image"] = $image;
        }

        $item_likes = Like::where('item_id', $item_id)->get();

        $user_id = Auth::id();
        $user_like = $item_likes->where('user_id', $user_id)->first();
        return view('item', compact('item', 'item_categories', 'item_comments', 'item_likes', 'user_like'));
    }

    public function purchase($item_id)
    {
        return view('purchase');
    }
}
