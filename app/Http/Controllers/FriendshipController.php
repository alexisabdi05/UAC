<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function sendFriendRequest(User $user)
    {
        Friendship::create([
            'user_id' => auth()->id(),
            'friend_id' => $user->id,
        ]);

        return redirect()->back()->with('friendRequestSent', 'Friend request sent successfully!');
    }
}

