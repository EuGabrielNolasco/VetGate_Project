<?php

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todos Animais e Vacinas') }}
        </h2>
    </x-slot>
    <br>
    <div class="container my-5">

        <h3>
            Todos Animais Deletados
        </h3>
        <hr>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">

                <a class="navbar-brand">Procurar por ID</a>

                <form action="{{ route('animals-search-deleteds') }}" method="get" class="d-flex">
                    @csrf
                    <input class="form-control me-2" type="search" name="search" placeholder="Search by ID" aria-label="Search">

                    <button class="btn btn-outline-success" type="submit">Buscar</button>

                </form>
            </div>
        </nav>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Tutor</th>
                        <th scope="col">Raça</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Info</th>
                        <th scope="col">Vacinas</th>
                        <th scope="col">Remover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($animals as $animal)
                    <tr>
                        <td>{{ $animal->id }}</td>
                        <td>{{ $animal->name }}</td>
                        <td>{{ $animal->owner_name }}</td>
                        <td>{{ $animal->species }}</td>
                        <td>
                            @if ($animal->birth)
                            {{ Carbon::createFromFormat('Y-m-d', $animal->birth)->diffInYears(Carbon::now()) }}
                            @else
                            N/A
                            @endif
                            Anos
                        </td>
                        <td>
                            <a href="{{ route('Animal-Deleted-inspect',['id'=>$animal->id]) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                </svg>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('vaccinations-deleted', ['id' => $animal->id]) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-heart" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5 1.5A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm5 0a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z"></path>
                                    <path d="M3 1.5h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2"></path>
                                    <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.31 8 6.982"></path>
                                </svg>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('animals-deleteds-destroy', $animal->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja excluir este animal Permanetemente?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center pagination-container">
                <nav aria-label="Page navigation">
                    {{ $animals->onEachSide(3)->appends(request()->query())->links('pagination::bootstrap-4', ['route' => 'animals-search']) }}
                </nav>
            </div>
            <br>

            <h3>
                Todas Vacinas Deletadas
            </h3>
            <hr>
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">

                    <a class="navbar-brand">Procurar por ID</a>

                    <form action="{{ route('animals-search') }}" method="get" class="d-flex">
                        @csrf
                        <input class="form-control me-2" type="search" name="search" placeholder="Search by ID" aria-label="Search">

                        <button class="btn btn-outline-success" type="submit">Buscar</button>

                    </form>
                </div>
            </nav>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Contactante</th>
                            <th scope="col">Vermifugação</th>
                            <th scope="col">Cadastro</th>
                            <th scope="col">Animal Id</th>
                            <th scope="col">Info</th>
                            <th scope="col">Remover</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vaccinations as $vaccination)
                        <tr>
                            <td>{{ $vaccination->id }}</td>
                            <td>{{ $vaccination->contactante }}</td>
                            <td>{{ $vaccination->dewormed_status }}</td>
                            <td>{{ Carbon::parse($vaccination->created_at)->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $vaccination->animal_id }}</td>
                            <td>
    <a href="{{ route('Vaccination-Deleted-inspect', ['id' => $vaccination->id]) }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
        </svg>
    </a>
</td>


                            <td>
                                a
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center pagination-container">
                    <nav aria-label="Page navigation">
                        {{ $vaccinations->onEachSide(3)->appends(request()->query())->links('pagination::bootstrap-4', ['route' => 'animals-search']) }}
                    </nav>
                </div>
                <br>

            </div>




        </div>

</x-app-layout>