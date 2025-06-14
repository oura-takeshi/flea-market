<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Purchase;
use App\Models\Category;
use App\Models\Condition;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\ExhibitionRequest;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $param = $request->page;
        $user_id = Auth::id();
        $not_have_items = Item::where('user_id', '!=', $user_id)->get();
        $like_items = Item::whereHas('likes', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->where('user_id', '!=', $user_id)->get();
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

    public function likeCreate($item_id)
    {
        $exist_like = like::where('item_id', $item_id)->where('user_id', Auth::id())->first();
        if ($exist_like == null) {
            like::create([
                'user_id' => Auth::id(),
                'item_id' => $item_id,
            ]);
        }
        return back();
    }

    public function likeDelete($item_id)
    {
        $exist_like = like::where('item_id', $item_id)->where('user_id', Auth::id())->first();
        if ($exist_like != null) {
            $exist_like->delete();
        }
        return back();
    }

    public function commentPost(CommentRequest $request)
    {
        comment::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'content' => $request->comment,
        ]);
        return back();
    }

    public function purchaseConfirm($item_id)
    {
        $item = Item::find($item_id);
        $user = Auth::user();
        $user_profile = $user->profile;
        if ($user_profile == null) {
            $post_code = null;
            $address = null;
            $building = null;
        } else {
            $post_code = $user_profile->post_code;
            $address = $user_profile->address;
            $building = $user_profile->building;
        }
        return view('purchase', compact('item', 'user', 'post_code', 'address', 'building'));
    }

    public function purchase(PurchaseRequest $request)
    {
        Purchase::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
            'payment_method' => $request->payment_method,
        ]);
        return redirect('/');
    }

    public function sell()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('sell', compact('categories', 'conditions'));
    }

    public function exhibition(ExhibitionRequest $request)
    {
        $data = $request->all();
        dd($data);
        return redirect('/');
    }
}
