<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        // Валидируем входящие данные
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Валидируем изображение
        ]);

        $user = Auth::user();

        // Если есть фото, обрабатываем его
        if ($request->hasFile('profile_photo')) {
            // Удаляем старое фото, если оно есть
            if ($user->profile_photo_path) {
                // Удаляем старое изображение из папки
                Storage::delete('public/' . $user->profile_photo_path);
            }

            // Загружаем новое изображение и сохраняем путь
            $path = $request->file('profile_photo')->store('profile_photos', 'public');

            // Обновляем путь к изображению в базе данных
            $user->profile_photo_path = $path;
        }

        // Сохраняем данные пользователя
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        // Перенаправляем пользователя на страницу профиля с сообщением об успехе
        return redirect()->route('profile.show')->with('success', 'Профиль обновлен!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Валидируем фото
        ]);

        $user = Auth::user();

        // Если загружено фото, сохраняем его
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public'); // Сохраняем файл в папке profile_photos

            // Обновляем путь к фото в базе данных
            $user->profile_photo_path = $photoPath;
        }

        // Сохраняем остальные данные
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('profile.show')->with('success', 'Профиль обновлен!');
    }

}
