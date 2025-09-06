<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        try {
            // Probar la conexión obteniendo algunos chats
            $chats = Chat::take(10)->get();
            
            return Inertia::render('Chat-Whatsapp', [
                'chats' => $chats,
                'connectionStatus' => 'success'
            ]);
        } catch (\Exception $e) {
            return Inertia::render('Chat-Whatsapp', [
                'chats' => [],
                'connectionStatus' => 'error',
                'error' => $e->getMessage()
            ]);
        }
    }
    
    /**
     * Crear un nuevo mensaje de chat
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required',
        ]);
        
        $chat = Chat::create([
            'message' => $request->message,
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'timestamp' => now(),
            'status' => 'sent',
            'type' => 'text'
        ]);
        
        return response()->json($chat);
    }
    
    /**
     * Obtener conversación entre dos usuarios
     */
    public function conversation($userId)
    {
        $chats = Chat::betweenUsers(auth()->id(), $userId)
                    ->recent(50)
                    ->get();
                    
        return response()->json($chats);
    }
}


