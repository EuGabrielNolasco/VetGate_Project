<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-authentication-card-logo />
            </div>
<br>
                {{-- Search Container --}}
                <div id="search-container" class="img-fluid position-relative d-flex align-items-center">
                    <!-- Sua imagem responsiva -->
                    <img src="{{ secure_asset('img/banner.jpg') }}" srcset="{{ secure_asset('img/banner.jpg') }} 500w, {{ secure_asset('img/banner.jpg') }} 800w" sizes="(max-width: 500px) 100vw, (max-width: 800px) 80vw, 100vw" class="img-fluid" alt="Imagem Responsiva">
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
                                    <span class="text-muted">Público </span>
                                    @endif
                                    <br>
                                    <div class="float-center">
                                        Em breve
                                    </div>

                                </div>

                                <div class="card-body">
                                    <img src="./img/events/{{ $event->image }}" class="img-fluid w-100 h-auto" alt="{{ $event->title }}" />
                                    <h5 class="card-title">{{ $event->title }}</h5>
                                    <p class="card-date">{{ date('d/m/Y', $eventDate) }}</p>
                                    <p class="card-text">{{ $event->city }}</p>
                                    <a href="/register" class="btn btn-primary">Saber mais</a>
                                </div>
                                <div class="card-footer text-muted">
                                    Postado a {{ $event->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    <div class="text-center mt-5">
                        <h1>Eventos Realizados</h1>
                        <hr />
                    </div>

                    {{-- Past Events --}}
                    <div class="row">
                        @foreach ($events as $event)
                        @php
                        $eventDate = strtotime($event->date);
                        $today = strtotime('today');
                        @endphp

                        @if ($eventDate < $today)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card mb-5 shadow-sm text-center border-danger">
                                <div class="card-header text-center">
                                    @if ($event->private == 1)
                                    <span class="text-muted">Privado</span>
                                    @else
                                    <span class="text-muted">Público </span>
                                    @endif
                                    <br>
                                    <div class="float-center">
                                        Evento Realizado
                                    </div>

                                </div>
                                <div class="card-body">
                                    <img src="./img/events/{{ $event->image }}" class="img-fluid w-100 h-auto" alt="{{ $event->title }}" />
                                    <h5 class="card-title">{{ $event->title }}</h5>
                                    <p class="card-date">{{ date('d/m/Y', $eventDate) }}</p>
                                    <p class="card-text">{{ $event->city }}</p>
                                    <a href="/register" class="btn btn-primary">Saber mais</a>
                                </div>

                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
    </div>
</x-guest-layout>
