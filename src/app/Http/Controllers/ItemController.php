<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $param = $request->page;
        $user_id = Auth::id();
        $items = Item::all();
        $user = Auth::user();
        $like_items = $user->items;
        return view('index', compact('param', 'user_id', 'items', 'like_items'));
    }
}
