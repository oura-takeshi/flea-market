<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chat($chat_id)
    {
        $chat = Chat::with('purchase.item')->find($chat_id);

        if (!$chat) {
            abort(403);
        }

        $user = Auth::user();
        $user_id = $user->id;
        $buyer_id = $chat->purchase->user_id;
        $seller_id = $chat->purchase->item->user_id;

        if ($user_id !== $buyer_id && $user_id !== $seller_id) {
            abort(403);
        }

        $other_chats = $user->activeChats()
        ->where('id', '!=', $chat_id)
        ->with('purchase.item')
        ->get();

        return view('chat', compact('chat', 'other_chats'));
    }
}
