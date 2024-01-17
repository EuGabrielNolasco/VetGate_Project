<x-guest-layout>
    <div class="pt-1 bg-gray-100">
        <div class="bg-gray-100 selection:bg-red-500 selection:text-white min-h-screen flex flex-col items-center ">
    @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Painel</a>
        @else
            <a href="{{ route('show-events') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Eventos&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Conecte-se</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registro</a>
            @endif
        @endauth
    </div>
@endif
<br>
            <div>
                <x-authentication-card-logo />
            </div>
<div class="max-w-7xl mx-auto p-6 lg:p-8">

    <h1 class="mt-8 text-2xl font-medium text-gray-900">
        Bem-vindo ao Vetgate, a sua aplicação dedicada aos cuidados dos animais!
    </h1>
    <p class="mt-6 text-gray-500 leading-relaxed">
    O Vetgate é o ponto de encontro ideal para todos os amantes de animais. Aqui, proporcionamos uma experiência única,
    conectando você a uma comunidade que compartilha o mesmo amor pelos animais de estimação. Além de oferecer um ambiente
    amigável, o Vetgate destaca-se pelos seus eventos especiais, onde você pode participar, aprender e interagir com outros
    entusiastas.
    <br>
    Não perca a oportunidade de criar sua conta! Ao fazer isso, você poderá cadastrar seus animais de estimação, garantindo
    que estejam sempre em dia com suas vacinas e cuidados essenciais. Junte-se a nós para promover a saúde e o bem-estar dos
    seus animais, participando ativamente da nossa comunidade dedicada aos cuidados animais.
    Seja parte do Vetgate e proporcione aos seus animais a atenção e carinho que eles merecem!
</p><br>

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
                                    <img src="./img/events/{{ $event->image }}" class="img-fluid w-100 h-auto" alt="{{ $event->title }}" /><br>
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
                                    <img src="./img/events/{{ $event->image }}" class="img-fluid w-100 h-auto" alt="{{ $event->title }}" /><br>
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
