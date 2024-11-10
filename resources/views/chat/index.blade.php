@extends('layouts.app')

@section('content')
    <div id="user-list" style="padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
        <h3 style="text-align: center; color: #333; font-family: Arial, sans-serif;">Select a user to start chatting</h3>
        <ul style="list-style: none; padding: 0;">
            @foreach($users as $user)
                <li style="background-color: #fff; margin: 10px 0; padding: 10px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); display: flex; align-items: center;">
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}'s profile photo" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 15px;">
                    <a href="{{ url('/chat/' . $user->id) }}" style="text-decoration: none; color: #007bff; font-size: 18px; font-weight: bold; display: block; padding: 5px 0;">
                        {{ $user->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
