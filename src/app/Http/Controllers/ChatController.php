<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show($chat_id)//未読メッセージ既読変更機能も追加する！
    {
        $chat = Chat::with('purchase.user.profile', 'purchase.item.user.profile', 'chatMessages.user.profile')->find($chat_id);

        if (!$chat) {
            abort(403);
        }

        $user = Auth::user();
        $buyer = $chat->purchase->user;
        $seller = $chat->purchase->item->user;

        if ($user->id !== $buyer->id && $user->id !== $seller->id) {
            abort(403);
        }

        $other_chats = $user->activeChats()
        ->where('id', '!=', $chat_id)
        ->with('purchase.item')
        ->get();

        $partner = $user->id === $buyer->id ? $seller : $buyer ;

        $is_buyer = $user->id === $buyer->id;

        $chat_messages = $chat->chatMessages()
        ->orderBy('created_at')
        ->get();

        return view('chat', compact('chat', 'other_chats', 'partner', 'is_buyer', 'chat_messages'));
    }
}
