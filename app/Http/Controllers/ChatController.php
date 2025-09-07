<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::all();
        
        return Inertia::render('Chat-Whatsapp', compact('chats'));
    }

}


