<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evento ') }} {{ $event->title }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
        <br><br>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-dark text-white">
                    <img class="card-img" src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
                    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center">
                        <!-- Optional: You can customize the card overlay content here -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="display-4">{{ $event->title }}</h1>
                <div class="d-flex flex-column">
                    <h3 class="mt-4">Cidade: </h3>
                    <ul class="list-group" id="items-list">
                        <li class="list-group-item">
                            <ion-icon name="location-outline">
                                <p class="lead">{{ $event->city }}</p>
                            </ion-icon>
                        </li>
                    </ul>
                    <h3 class="mt-4">Responsável: </h3>
                    <ul class="list-group" id="items-list">
                        @if ($eventOwner)
                        <li class="list-group-item">
                            <ion-icon name="star-outline">
                                <p>{{ $eventOwner['name'] }}</p>
                            </ion-icon>
                        </li>
                        @endif
                    </ul>
                </div>

                <h3 class="mt-4">O evento conta com:</h3>
                <ul class="list-group" id="items-list">
                    @foreach ($event->items as $item)
                    <li class="list-group-item"><ion-icon name="play-outline"></ion-icon> {{ $item }}</li>
                    @endforeach
                </ul>

                <div class="mt-4">
                    <h3>Sobre o evento:</h3>
                    <ul class="list-group" id="items-list">
                        <li class="list-group-item">
                            <ion-icon name="play-outline">
                                <p class="lead">{{ $event->description }}</p>
                            </ion-icon>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>