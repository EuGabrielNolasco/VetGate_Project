<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inspecionar Animais') }}
        </h2>
    </x-slot>

    <div class="container mt-3">
    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="/admin/animals" class="btn btn-warning">Voltar</a>
</div>

        <br><br>
        <form class="row g-3 needs-validation" novalidate>

        <div class="col-md-6">
                <label for="name"><b>Data de Entrada do animal:</b></label>
                <input fieldset disabled type="text" class="form-control" name="created_at" value="{{ $animal->created_at }}" placeholder="Digite um nome...">
        </div>
        <div class="col-md-6">
                <label for="name"><b>Ultima Modificação feita:</b></label>
                <input fieldset disabled type="text" class="form-control" name="updated_at" value="{{ $animal->updated_at }}" placeholder="Digite um nome...">
        </div>

            <div class="col-md-12">
                <label for="inputNomePet" class="form-label">Nome do Animal</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="name" value="{{ $animal->name }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira o nome do animal.
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label for="owner_name">Nome do Tutor:</label>
                <input fieldset disabled type="text" class="form-control" name="owner_name" value="{{ $animal->owner_name }}" placeholder="Digite o nome do tutor...">
            </div>
            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Bairro</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="neighborhood" value="{{ $animal->neighborhood }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira o Bairro.
                    </div>
                </div>
            </div>
            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Endereço</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="address" value="{{ $animal->address }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira o Endereço.
                    </div>
                </div>
            </div>
            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Contato do tutor: Celular</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="contact" oninput="validateContact(this)" placeholder="(99)9 9999-9999" value="{{ $animal->contact }}">
                    <div class="invalid-feedback">
                        Por favor, insira o Contato com 11 dígitos.
                    </div>
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Raça</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="race" value="{{ $animal->race }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira a Raça.
                    </div>
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Especie</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="species" value="{{ $animal->species }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira a Especie.
                    </div>
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Vida Reprodutiva</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="reproductive_status" value="{{ $animal->reproductive_status }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira a vida reprodutiva.
                    </div>
                </div>
            </div>

            <br>

            <div class="form-group">
                <label for="inputNascimento">Nascimento</label>
                <input fieldset disabled type="text" class="form-control" value="{{ $animal->birth ? \Carbon\Carbon::parse($animal->birth)->format('d/m/Y') : '' }}" />

            </div>
            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Rotina</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="exercise_routine" value="{{ $animal->exercise_routine }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira a Rotina.
                    </div>
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Porte</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="size" value="{{ $animal->size }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira o Porte.
                    </div>
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Pelo do Animal</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="fur_length" value="{{ $animal->fur_length }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira o tamanho do pelo do animal.
                    </div>
                </div>
            </div>

            <br>

            <div class="col-md-6">
                <label for="inputNomePet" class="form-label">Precedendia</label>
                <div class="input-group has-validation">
                    <input fieldset disabled type="text" class="form-control" id="invalidCheck" required name="origin" value="{{ $animal->origin }}" placeholder="Digite um nome...">
                    <div class="invalid-feedback">
                        Porfavor Insira a Precedencia.
                    </div>
                </div>
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