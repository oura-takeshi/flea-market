<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function chat($chat_id)
    {
        $chat = Chat::find($chat_id);
        if (!$chat) {
            return redirect('/');
        }

        return view('chat');
    }
}
