<?php

use Carbon\Carbon; ?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Animais de :userName', ['userName' => $user->name]) }}
        </h2>
    </x-slot>

    <div class="container mt-5">

    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="/admin/view" class="btn btn-warning">Voltar</a>
</div>
        <p><br>O administrador tem um total de {{ $totalAnimais }} animais.</p>
        <div class="table-responsive">

            <table class="table table-bordered">
                <br>
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Tutor</th>
                        <th scope="col">Raça</th>
                        <th scope="col">Idade</th>
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


                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
</x-app-layout>