<?php

use Illuminate\Pagination\Paginator;

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todos Usuarios') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">Procurar por Nome</a>
                <form action="{{ route('users-search') }}" method="get" class="d-flex">
                    @csrf
                    <input class="form-control me-2" type="search" name="search" placeholder="Search by Name" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Ver Animais</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 1)
                            <span>Admin</span>
                            @else
                            <span>Usuario</span>
                            @endif
                        </td>


                        <td>
                            <a href="{{ route('usersAnimals-index',['id'=>$user->id]) }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2" />
                                </svg>
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center pagination-container">
            <nav aria-label="Page navigation">
            {{ $users->onEachSide(3)->withQueryString()->links('pagination::bootstrap-4', ['route' => 'users-search']) }}

            </nav>
        </div>
        <br>
        </div>
    </div>
</x-app-layout>