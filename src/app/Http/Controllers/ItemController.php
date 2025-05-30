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
        if ($user != null) {
            $user_items = $user->items;
        } else {
            $user_items = null;
        }
        return view('index', compact('param', 'user_id', 'items', 'user_items'));
    }

    public function detail($item_id)
    {
        return view('item');
    }
}
