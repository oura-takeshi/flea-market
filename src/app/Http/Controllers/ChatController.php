<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show($chat_id)
    {
        $chat = Chat::with('purchase.user.profile', 'purchase.item.user.profile', 'chatMessages.user.profile')->findOrFail($chat_id);

        $user = Auth::user();
        $buyer = $chat->purchase->user;
        $seller = $chat->purchase->item->user;

        $this->authorize('participate', $chat);

        $chat->chatMessages()
        ->where('is_read', false)
        ->where('user_id', '!=', $user->id)
        ->update(['is_read' => true]);

        $other_chats = $user->visibleActiveChats()
        ->where('id', '!=', $chat_id)
        ->with('purchase.item')
        ->get();

        $partner = $user->id === $buyer->id ? $seller : $buyer ;
        $is_buyer = $user->id === $buyer->id;

        $has_reviewed = Review::where('chat_id', $chat_id)
        ->where('reviewer_id', $user->id)
        ->exists();

        $buyer_reviewed = Review::where('chat_id', $chat_id)
        ->where('reviewer_id', $buyer->id)
        ->exists();

        $force_review_modal = $user->id === $seller->id && $buyer_reviewed && !$has_reviewed;

        $chat_messages = $chat->chatMessages()
        ->orderBy('created_at')
        ->get();

        return view('chat', compact('chat', 'other_chats', 'partner', 'is_buyer', 'force_review_modal', 'chat_messages'));
    }
}
