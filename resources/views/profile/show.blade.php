@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Профиль пользователя</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Скрытые поля для широты и долготы -->
            <input type="hidden" name="latitude" id="latitude" value="{{ $user->latitude }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ $user->longitude }}">

            <!-- Фото профиля -->
            <div class="form-group">
                <label for="profile_photo">Фото профиля</label>
                <input type="file" name="profile_photo" id="profile_photo" class="form-control">
                @if ($user->profile_photo_path)
                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Фото профиля" class="img-thumbnail mt-2" style="width: 150px; height: 150px;">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Фото профиля" class="img-thumbnail mt-2" style="width: 150px; height: 150px;">
                @endif
            </div>

            <!-- Карта для выбора местоположения -->
            <div id="map" style="height: 400px; width: 100%;"></div>

            <button type="submit" class="btn btn-primary mt-3">Сохранить изменения</button>
        </form>
    </div>

    <!-- Подключение Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userLat = {{ $user->latitude ?? 43.2380 }};
            const userLng = {{ $user->longitude ?? 76.8829 }};

            const map = L.map('map').setView([userLat, userLng], 10);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            // Устанавливаем маркер на карту
            let marker = L.marker([userLat, userLng], { draggable: true }).addTo(map)
                .bindPopup("Ваше текущее местоположение").openPopup();

            // Функция для обновления координат
            function updateCoordinates(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                console.log('Updated coordinates:', lat, lng); // Отладка: выводим в консоль
            }

            // Обновляем координаты, когда маркер перемещается
            marker.on('dragend', function(e) {
                const position = marker.getLatLng();
                updateCoordinates(position.lat, position.lng);
            });

            // Клик по карте для перемещения маркера
            map.on('click', function(e) {
                const { lat, lng } = e.latlng;
                updateCoordinates(lat, lng);
                marker.setLatLng([lat, lng]);
            });
        });
    </script>
@endsection
