<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Events\MessageSent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Получаем список пользователей с ролью "emergency", кроме текущего пользователя
        // Получаем список пользователей с ролью 'emergency', исключая текущего пользователя
        $users = User::where('id', '!=', auth()->user()->id)
            ->where('role_id', 5) // Фильтруем пользователей с ролью 'emergency' (role_id = 3)
            ->get();


        return view('chat.index', compact('users'));
    }


    public function showChat($receiverId)
    {
        // Получаем текущего пользователя
        $user = auth()->user();

        // Получаем пользователя-получателя
        $receiver = User::findOrFail($receiverId);

        // Получаем все сообщения между пользователем и получателем
        $messages = Message::where(function($query) use ($user, $receiver) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $receiver->id);
        })
            ->orWhere(function($query) use ($user, $receiver) {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Получаем список всех пользователей, с которыми текущий пользователь общался
        $senderUsers = Message::where(function($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->orWhere('receiver_id', $user->id);
        })
            ->distinct()
            ->pluck('sender_id', 'receiver_id')
            ->flatten()
            ->unique()
            ->filter(function($id) use ($user) {
                return $id != $user->id; // Исключаем текущего пользователя
            });

        // Получаем информацию о каждом пользователе, с которым текущий пользователь общался
        $senderUsers = User::whereIn('id', $senderUsers)->get();

        return view('chat.chat', compact('messages', 'receiverId', 'senderUsers'));
    }


    public function sendMessage(Request $request)
    {
        // Выводим все данные запроса для отладки
        // dd($request->all());

        // Получаем текущего пользователя (отправителя)
        $sender = auth()->user();

        // Получаем получателя по ID
        $receiver = User::find($request->receiver_id);

        if (!$receiver) {
            return response()->json(['error' => 'Получатель не найден'], 404);
        }

        // Создаем сообщение
        $message = new Message();
        $message->sender_id = Auth::id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;

        // Обработка изображения
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $message->image = $imagePath;
        }

        // Обработка локации
        if ($request->has('latitude') && $request->has('longitude')) {
            $message->latitude = $request->latitude;
            $message->longitude = $request->longitude;
        }

        $message->save();

        // Отправляем сообщение через WebSockets
        broadcast(new MessageSent($message));

        return back()->with('status', 'Message sent!');
    }


}

