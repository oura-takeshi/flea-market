<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
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

    public function update(Request $request, $chat_id, $chat_message_id)
    {
        $chat = Chat::findOrFail($chat_id);

        $this->authorize('participate', $chat);

        $message = ChatMessage::where('id', $chat_message_id)
            ->where('chat_id', $chat_id)
            ->firstOrFail();

        if ($message->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = validator(
            $request->all(),
            [
                "edit_content_{$message->id}" => 'required|max:400',
            ],
            [
                "edit_content_{$message->id}.required" => '本文を入力してください',
                "edit_content_{$message->id}.max" => '本文は400文字以内で入力してください',
            ]
        )->validateWithBag('edit');

        $message->update([
            'content' => $validated["edit_content_{$message->id}"],
            'is_read' => false,
        ]);

        return back();
    }

    public function destroy($chat_id, $chat_message_id)
    {
        $chat = Chat::findOrFail($chat_id);

        $this->authorize('participate', $chat);

        $message = ChatMessage::where('id', $chat_message_id)
            ->where('chat_id', $chat_id)
            ->firstOrFail();

        if ($message->user_id !== Auth::id()) {
            abort(403);
        }

        if ($message->image) {
            Storage::disk('public')->delete($message->image);
        }

        $message->delete();

        return back();
    }
}
