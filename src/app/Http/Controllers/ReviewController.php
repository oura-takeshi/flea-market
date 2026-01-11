<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request, $chat_id)
    {
        $chat = Chat::with(['purchase.item'])->findOrFail($chat_id);

        $this->authorize('participate', $chat);

        $validated = $request->validate([
            'score' => ['required', 'integer', 'between:1,5'],
        ]);

        $user_id = Auth::id();
        $buyer_id = $chat->purchase->user_id;
        $seller_id = $chat->purchase->item->user_id;

        if ($user_id === $buyer_id) {
            $reviewee_id = $seller_id;
        } elseif ($user_id === $seller_id) {
            $reviewee_id = $buyer_id;
        } else {
            abort(403);
        }

        $already_reviewed = Review::where('chat_id', $chat->id)
            ->where('reviewer_id', $user_id)
            ->exists();

        if ($already_reviewed) {
            abort(403, 'すでに評価済みです');
        }

        Review::create([
            'chat_id'     => $chat->id,
            'reviewer_id' => $user_id,
            'reviewee_id' => $reviewee_id,
            'score'     => $validated['score'],
        ]);

        $review_count = Review::where('chat_id', $chat->id)->count();

        if ($review_count >= 2) {
            $chat->update([
                'is_finished' => true,
            ]);
        }

        return redirect('/');
    }
}
