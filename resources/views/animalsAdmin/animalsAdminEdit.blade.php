<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Vacinação') }}
        </h2>
    </x-slot>

    <div class="container mt-3">

    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="/admin/animals" class="btn btn-warning">Voltar</a>
</div>

        
        <br><br>
        <form action="{{ url('/admin/animals/vaccinations/store', ['animalId' => $animal->id]) }}" method="post" class="row g-3 needs-validation" novalidate>

            @csrf

            <br>
            <div class="col-md-6">
                <label for="name"><b>Nome do Animal:</b></label>
                <input fieldset disabled type="text" class="form-control" name="" value="{{ $animal->name }}" placeholder="Digite um nome...">
            </div>
            <br>

            <div class="col-md-6">
                <label for="owner_name"><b>Nome do Tutor:</b></label>
                <input fieldset disabled type="text" class="form-control" name="" value="{{ $animal->owner_name }}" placeholder="Digite o nome do tutor...">
            </div>

            <br>

            <div class="col-md-6">
                <label for="owner_name"><b>Contactante:</b></label>
                <input fieldset disabled type="text" class="form-control" name="contactante" value="{{ $user->name }}" placeholder="Digite o nome do contactante...">
                <div class="invalid-feedback">
                    Porfavor Insira o nome do Pet.
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="contact"><b>Vacinado?:</b></label>
                <input type="text" class="form-control" name="vaccinated_status" placeholder="Vazio">
            </div>

            <br>

            <div class="col-md-6">
                <label for="contact"><b>Vermifugação:</b></label>
                <input type="text" class="form-control" name="dewormed_status" placeholder="Vazio">
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputIdade" class="form-label"><b>Ultima Vermifugação</b></label>
                <div class="input-group has-validation">
                    <input type="text" id="datepicker" name="date_dewormed" class="form-control" required readonly placeholder="dd/mm/YYYY">
                    <script>
                        $(document).ready(function() {
                            $('#datepicker').datepicker({
                                uiLibrary: 'bootstrap5',
                                format: 'dd/mm/yyyy' // Especifica o formato desejado
                            });

                            // Adiciona um manipulador de eventos para o formulário
                            $('form').submit(function() {
                                // Verifica se a data de nascimento está preenchida
                                if ($('#datepicker').val() === '') {
                                    // Exibe a mensagem de feedback inválida
                                    $('#datepicker').addClass('is-invalid');
                                    return false; // Impede o envio do formulário
                                }
                            });
                        });
                    </script>
                </div>
            </div>


            <br>

            <div class="col-md-12">
                <label for="contact"><b>Saude:</b></label>
                <input type="text" class="form-control" name="health_status" placeholder="Vazio">
            </div>

            <br>

            <div class="form-group">
                <label for="contact"><b>Frequencia Respiratoria:</b></label>
                <input type="text" class="form-control" name="respiratory_rate" placeholder="Vazio">
            </div>

            <br>

            <div class="form-group">
                <label for="contact"><b>Frequência Cardíaca:</b></label>
                <input type="text" class="form-control" name="heart_rate" placeholder="Vazio">
            </div>

            <br>

            <input type="hidden" name="animal_id" value="{{ $animal->id }}">

            <div class="col-md-6">
    <label for="name"><b>Data de Entrada do animal:</b></label>
    <input fieldset disabled type="text" class="form-control" name="created_at" placeholder="Digite um nome..." value="{{ \Carbon\Carbon::parse($animal->created_at)->locale('pt_BR')->isoFormat('dddd, D [de] MMMM [de] YYYY H:mm:ss') }}">
</div>

<div class="col-md-6">
    <label for="name"><b>Última Modificação feita:</b></label>
    <input fieldset disabled type="text" class="form-control" name="updated_at" placeholder="Digite um nome..." value="{{ \Carbon\Carbon::parse($animal->updated_at)->locale('pt_BR')->isoFormat('dddd, D [de] MMMM [de] YYYY H:mm:ss') }}">
</div>

            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                    Concorde com os termos e condições
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-outline-success" onclick="validateForm()">Cadastrar</button>
            </div>
            <br>


            <script>
                (function() {
                    'use strict'

                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.querySelectorAll('.needs-validation')

                    // Loop over them and prevent submission
                    Array.prototype.slice.call(forms)
                        .forEach(function(form) {
                            form.addEventListener('submit', function(event) {
                                if (!form.checkValidity()) {
                                    event.preventDefault()
                                    event.stopPropagation()
                                }

                                form.classList.add('was-validated')
                            }, false)
                        })
                })()
            </script>

        </form>
        <br>

    </div>
</x-app-layout>