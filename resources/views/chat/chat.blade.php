@extends('layouts.app')

@section('content')
<style>
        .message-sent {
            max-width: 60%;
            text-align: right;
        }

        .message-received {
            max-width: 60%;
        }

        .message img {
            margin-top: 5px;
            border-radius: 5px;
        }

        #messages {
            max-height: 500px;
            overflow-y: auto;
        }

        /* Стили для контейнера профиля */
        .profile-img-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 50%; /* Округлая форма */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Стили для картинки профиля */
        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Обрезка картинки по краям */
        }

        /* Стили для черного круга, если фото нет */
        .default-img {
            background-color: black;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        /* Стили для имени пользователя */
        .sender-name {
            font-size: 16px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }

        .sender-name:hover {
            color: #007bff; /* Цвет при наведении */
        }
        /* Основной стиль для контейнера сообщений */
        #messages {
            max-height: 500px; /* Ограничиваем высоту, чтобы можно было прокручивать */
            overflow-y: scroll; /* Добавляем вертикальную прокрутку */
            padding-left: 15px;
        }

        /* Стиль для каждого сообщения */
        .message {
            display: flex;
            margin-bottom: 15px;
        }

        /* Стиль для отправленных сообщений */
        .message-sent {
            background-color: #007bff; /* Синий фон для отправленных сообщений */
            color: white;
            padding: 10px;
            border-radius: 10px;
            max-width: 75%;
            margin-left: auto; /* Сдвигаем на правую сторону */
            position: relative;
            word-wrap: break-word;
        }

        /* Стиль для полученных сообщений */
        .message-received {
            background-color: #f8f9fa; /* Светлый фон для полученных сообщений */
            padding: 10px;
            border-radius: 10px;
            max-width: 75%;
            word-wrap: break-word;
        }

        /* Стили для изображения в сообщении */
        .message img {
            margin-top: 10px;
            max-width: 100%;
            height: auto;
        }

        /* Стили для ссылки на карту */
        .message a {
            color: #007bff;
            text-decoration: none;
        }

        /* Стили для формы отправки сообщения */
        form {
            margin-top: 20px;
            width: 500px;
        }

        /* Стили для текстового поля сообщения */
        textarea {
            height: 80px;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            margin-left: 70px;
        }

        /* Стили для кнопки отправки */
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Стили для карты (Leaflet) */
        #map {
            height: 400px;
            width: 100%;
            margin-top: 20px;
        }

        /* Стили для загрузки изображения */
        input[type="file"] {
            margin-top: 10px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

</style>
<div id="chat" class="container mt-4">
    <div class="d-flex">
        <!-- Боковая панель (список отправителей) -->
        <div id="senders" class="mb-3" style="width: 250px; border-right: 1px solid #ddd; padding-right: 15px; display: flex; flex-direction: column; height: 100vh; justify-content: space-between;">
            <div>
                <h5>Message</h5>
                <ul class="list-unstyled">
                    @foreach($senderUsers as $sender)
                        <li class="d-flex align-items-center mb-3">
                            <!-- Профильная картинка или черный круг -->
                            <div class="profile-img-wrapper mr-3">
                                @if($sender->profile_photo_path)
                                    <img src="{{ asset('storage/' . $sender->profile_photo_path) }}" alt="{{ $sender->name }}" class="profile-img">
                                @else
                                    <div class="profile-img default-img"></div>
                                @endif
                            </div>
                            <a href="{{ url('/chat/' . $sender->id) }}" class="sender-name">
                                {{ $sender->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Чат (основная часть) -->
        <div id="messages" class="flex-grow-1 mb-3" style="padding-left: 15px; height: 100vh; overflow-y: auto;">
            @foreach($messages as $message)
                <div class="message d-flex mb-3">
                    @if ($message->sender_id == auth()->id())
                        <div class="ml-auto message-sent bg-primary text-white p-2 rounded">
                            <p class="mb-0"><strong>{{ $message->sender->name }}:</strong> {{ $message->message }}</p>
                            @if ($message->image)
                                <img src="{{ asset('storage/' . $message->image) }}" alt="Image" class="img-fluid" width="100">
                            @endif
                            @if ($message->latitude && $message->longitude)
                                <p><strong>Location:</strong> <a href="https://www.google.com/maps?q={{ $message->latitude }},{{ $message->longitude }}" target="_blank">View on map</a></p>
                                <p><strong>Distance:</strong> {{ $message->calculateDistance(auth()->user()) }} km</p>
                            @endif
                        </div>
                    @else
                        <div class="message-received bg-light p-2 rounded">
                            <p class="mb-0"><strong>{{ $message->sender->name }}:</strong> {{ $message->message }}</p>
                            @if ($message->image)
                                <img src="{{ asset('storage/' . $message->image) }}" alt="Image" class="img-fluid" width="100">
                            @endif
                            @if ($message->latitude && $message->longitude)
                                <p><strong>Location:</strong> <a href="https://www.google.com/maps?q={{ $message->latitude }},{{ $message->longitude }}" target="_blank">View on map</a></p>
                                <p><strong>Distance:</strong> {{ $message->calculateDistance(auth()->user()) }} km</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <!-- Форма для отправки сообщения (снизу слева) -->
    <form action="{{ url('/chat/send') }}" method="POST" enctype="multipart/form-data" class="mt-3" style="margin-left: 200px;">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $receiverId }}">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <div class="form-group d-flex align-items-center">
            <!-- Иконка для ввода сообщения -->
            <textarea style="width: 800px" name="message" class="form-control" placeholder="Type a message" required></textarea>


            <!-- Иконка для прикрепления фото -->
            <label for="image" class="btn btn-link ml-2" style="font-size: 24px; color: #007bff;">
                <i class="fas fa-camera"></i>
            </label>
            <input type="file" name="image" id="image" class="d-none">

            <!-- Иконка для отправки сообщения -->
            <button type="submit" class="btn btn-link ml-2" style="font-size: 24px; color: #007bff;">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </form>


    <!-- Карта для отправки локации -->
    <div id="map" style="height: 400px; width: 100%;"></div>
    <!-- Подключение Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</div>



<script>
        document.addEventListener('DOMContentLoaded', () => {
            const userLat = {{ $user->latitude ?? 43.2380 }};
            const userLng = {{ $user->longitude ?? 76.8829 }};

            const map = L.map('map').setView([userLat, userLng], 10);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            let marker = L.marker([userLat, userLng], { draggable: true }).addTo(map)
                .bindPopup("Your current location").openPopup();

            marker.on('dragend', function(e) {
                const position = marker.getLatLng();
                document.getElementById('latitude').value = position.lat;
                document.getElementById('longitude').value = position.lng;
            });

            map.on('click', function(e) {
                const { lat, lng } = e.latlng;
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                marker.setLatLng([lat, lng]);
            });

            // Отправка локации
            document.getElementById('send-location').addEventListener('click', function() {
                document.querySelector('form').submit();
            });
        });
    </script>
@endsection

