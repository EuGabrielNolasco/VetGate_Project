<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel Administrador') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
        </div>
        <div class="mt-5">
        <h4 class="alert-heading">Olá, tudo bem?</h4>
        <p class="mb-0">O Vetgate tem uma mensagem especial para você:</p>
        <hr>
        <p class="mb-0">Leia este pequeno aviso com carinho!</p>
            <p class="mt-3 text-gray-500 leading-relaxed">
                Lembre-se de ter cuidado ao apagar algum admin, pois esse item irá para os deletados. Evite criar muitos admins para não permitir que alguém mal-intencionado prejudique o sistema. Seja parte do Vetgate e proporcione aos seus animais a atenção e carinho que eles merecem!
            </p>
        </div><br>
        <div class="card col-sm-12 mt-3">
            <div class="card-body">
                <h5 class="card-title">Cadastrar Administradores</h5>
                <p class="card-text">Clique no botão abaixo para gerenciar admins.</p>
                <a href="{{ route('admin-create') }}" class="btn btn-success">Cadastrar Admins</a>
            </div>
        </div>
        <br>
        <div class="card col-sm-12 mt-3">
            <div class="card-body">
                <h5 class="card-title">Gerenciar Administradores</h5>
                <p class="card-text">Clique no botão abaixo para gerenciar admins.</p>
                <a href="{{ route('admin-view') }}" class="btn btn-primary">Gerenciar Admins</a>
            </div>
        </div>

    </div>
</x-app-layout>
