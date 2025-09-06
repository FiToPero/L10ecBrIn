<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::take(10)->get();
        
        return Inertia::render('Chat-Whatsapp', ['chats' => $chats]);
    }

}


