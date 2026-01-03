<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatMessageRequest;

class ChatMessageController extends Controller
{
    public function store(ChatMessageRequest $request, $chat_id)
    {
        return back();
    }
}
