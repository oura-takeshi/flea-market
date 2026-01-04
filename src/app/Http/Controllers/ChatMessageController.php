<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Http\Requests\ChatMessageRequest;

class ChatMessageController extends Controller
{
    public function store(ChatMessageRequest $request, $chat_id)
    {
        $chat = Chat::findOrFail($chat_id);

        $this->authorize('participate', $chat);

        $path = null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/chat_messages', 'public');
        }

        ChatMessage::create([
            'chat_id' => $chat_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'image' => $path,
        ]);

        return back();
    }
}
