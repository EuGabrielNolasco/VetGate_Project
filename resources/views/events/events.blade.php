<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos') }}
        </h2>
    </x-slot>

    {{-- Search Container --}}
    <div id="search-container" class="img-fluid position-relative d-flex align-items-center">
        <!-- Imagem para dispositivos pequenos (por exemplo, celulares) -->
        <img src="{{ asset('img/banner.jpg') }}" srcset="{{ asset('img/banner.jpg') }} 500w, {{ asset('img/banner.jpg') }} 800w" sizes="(max-width: 500px) 100vw, (max-width: 800px) 80vw, 100vw" class="img-fluid" alt="Imagem Responsiva">
    </div>

    {{-- Event listing --}}
    <div class="container my-5">
        <div class="text-center">
            <h1>Próximos Eventos</h1>
            <hr />
        </div>

        {{-- Upcoming Events --}}
        <div class="row">
            @foreach ($events as $event)
            @php
            $eventDate = strtotime($event->date);
            $today = strtotime('today');
            @endphp

            @if ($eventDate >= $today)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-5 shadow-sm text-center border-success">
                    <div class="card-header text-center">
                        @if ($event->private == 1)
                        <span class="text-muted">Privado</span>
                        @else
                        <span class="text-muted">Público  </span>
                        @endif
                        <div class="float-right">
                            Em breve
                        </div>
                    
                    </div>

                    <div class="card-body">
                        <img src="./img/events/{{ $event->image }}" class="img-fluid w-100 h-auto" alt="{{ $event->title }}" />
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-date">{{ date('d/m/Y', $eventDate) }}</p>
                        <p class="card-text">{{ $event->city }}</p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                    </div>
                    <div class="card-footer text-muted">
                        Postado a {{ $event->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        <div class="text-center">
            <h1>Eventos Passados</h1>
            <hr />
        </div>

        {{-- Past Events --}}
        <div class="row">
            @foreach ($events as $event)
            @php
            $eventDate = strtotime($event->date);
            $today = strtotime('today');
            @endphp

            @if ($eventDate < $today) <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mb-5 shadow-sm text-center border-danger">
                <div class="card-header text-center">
                        @if ($event->private == 1)
                        <span class="text-muted">Privado</span>
                        @else
                        <span class="text-muted">Público  </span>
                        @endif
                        <div class="float-right">
                            Evento Realizado
                        </div>
                    
                    </div>
                    <div class="card-body">
                        <img src="./img/events/{{ $event->image }}" class="img-fluid w-100 h-auto" alt="{{ $event->title }}" />
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-date">{{ date('d/m/Y', $eventDate) }}</p>
                        <p class="card-text">{{ $event->city }}</p>
                        <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
                    </div>

                </div>
        </div>
        @endif
        @endforeach
    </div>
    
    </div>
    
</x-app-layout>