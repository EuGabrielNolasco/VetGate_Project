<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todos Administradores') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
        </div><br><br>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand">Procurar por Nome</a>
                <form action="{{ route('usersAdmin-search') }}" method="post" class="d-flex">
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
                        <th scope="col">Animais</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        @if($user->role == 1)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('usersAdminAnimals-index',['id'=>$user->id]) }}" class="btn btn-primary">Ver Animais</a>
                                </td>
                                <td>
                                    @if($user->id != 1)
                                        <form action="{{ route('admin-destroy', ['id' => $user->id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja excluir este administrador?')">Deletar Admin</button>
                                        </form>
                                    @else
                                        <!-- Opção negada ou mensagem indicando que não pode ser deletado -->
                                        Opção negada
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5">Nenhum usuário encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
