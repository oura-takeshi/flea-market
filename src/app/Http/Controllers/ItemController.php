<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $param = $request->page;
        $items = Item::all();
        return view('index', compact('param', 'items'));
    }
}
