<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatPolicy
{
    use HandlesAuthorization;

    public function participate(User $user, Chat $chat): bool
    {
        $buyer_id = $chat->purchase->user_id;
        $seller_id = $chat->purchase->item->user_id;

        return $user->id === $buyer_id || $user->id === $seller_id;
    }

    public function buyer(User $user, Chat $chat): bool
    {
        return $user->id === $chat->purchase->user_id;
    }

    public function seller(User $user, Chat $chat): bool
    {
        return $user->id === $chat->purchase->item->user_id;
    }
}
