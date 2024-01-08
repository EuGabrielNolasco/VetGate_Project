<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Eventos') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
        </div>
        <div class="row">
            
            <div class="col-md-10 offset-md-1">
                <div class="dashboard-title-container">
                    <br>
                    <h1>Meus Eventos</h1>
                </div>

                <div class="dashboard-events-container">
                    @if (count($events) > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Deletar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                                            <td>
                                                <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn">
                                                    <ion-icon name="create-outline"></ion-icon> Editar
                                                </a>
                                            </td>
                                            <td>
                                                <form action="/events/{{ $event->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger delete-btn" onclick="return confirm('Tem certeza de que deseja excluir este evento?')">
                                                        <ion-icon name="trash-outline"></ion-icon> Deletar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>Você ainda não tem eventos, <a href="/events/create">criar evento</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
