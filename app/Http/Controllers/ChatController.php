<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Chat;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Chat::class);

        $chats = Chat::all();
        $messages = Message::all();
        
        return Inertia::render('Chat-Whatsapp', [
            'chats' => $chats,
            'messages' => $messages,
            'photoUrl' => asset('storage/users/images/photo_1.jpg')
        ]);
    }

}


