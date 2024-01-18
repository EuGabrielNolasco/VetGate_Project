<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inspecionando Vacina Deletada') }}
        </h2>
    </x-slot>

    <div class="container mt-3">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
        </div>
        <div class="row">

        <br>

            <div class="col-md-12">
                <br>
                <label for="name"><b>Data de Criação da Vacina:</b></label>
                <input fieldset disabled type="text" class="form-control" name="created_at" value="{{ $vaccination->created_at }}" placeholder="Digite um nome...">
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Id da Vacina:</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="name" value="{{ $vaccination->id }}" placeholder="Digite um nome...">
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="owner_name">Id do Animal Vacinado:</label>
                <input fieldset disabled type="text" class="form-control" name="owner_name" value="{{ $vaccination->animal_id }}" placeholder="Sem animal vinculado a esta vacina">
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Contactante:</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="neighborhood" value="{{ $vaccination->contactante }}" placeholder="Digite um nome...">
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Vacinado?</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="address" value="{{ $vaccination->vaccinated_status }}" placeholder="Digite um nome...">
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Vermifugação:</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="contact" oninput="validateContact(this)" placeholder="(99)9 9999-9999" value="{{ $vaccination->dewormed_status }}">

                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Ultima Vermifugação:</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="race" value="{{ $vaccination->date_dewormed }}" placeholder="Digite um nome...">

                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Saude:</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="species" value="{{ $vaccination->health_status }}" placeholder="Digite um nome...">

                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Frequencia Respiratoria:</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="reproductive_status" value="{{ $vaccination->respiratory_rate }}" placeholder="Digite um nome...">

                </div>
            </div>

            <br>

            <div class="form-group">
                <label for="inputNascimento">Frequência Cardíaca:</label>
                <input fieldset disabled type="text" class="form-control" value="{{$vaccination->heart_rate}}">

            </div>

        </div>
    </div>
</x-app-layout>