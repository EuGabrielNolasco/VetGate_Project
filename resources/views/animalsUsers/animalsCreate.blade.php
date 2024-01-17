<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Cadastrar Animais') }}

    </h2>
  </x-slot>
  @if(Auth::check() && Auth::user()->role == 0)
  @if($count == 10)
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Cuidado! </strong> Você já possui 10 animais, caso tentar cadastrar mais ira falhar!
    <button type="button" data-bs-dismiss="danger" aria-label="Close"></button>
  </div>
  @else
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Olá, Tudo bem?</strong> Você só pode cadastrar até 10 animais.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @endif





  <div class="container mt-3">
    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
      <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
    </div>
  </div>
  <br>
  <form class="row g-3 needs-validation " novalidate action="{{ route('animalsUsers-store') }}" method="post">
    @csrf
    <div class="col-md-6">
      <label for="inputNomePet" class="form-label">Nome do Animal</label>
      <div class="input-group has-validation">
        <input type="text" class="form-control" id="invalidCheck" required name="name" placeholder="Rex">
        <div class="invalid-feedback">
          Porfavor Insira o nome do Pet.
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <label for="inputNomePet" class="form-label">Tutor</label>
      <input fieldset disabled type="text" class="form-control" name="owner_name" value="{{ $loggedInUser->name }}" placeholder="Digite o nome do tutor...">
    </div>


    <div class="col-md-12">
      <label for="inputNomePet" class="form-label">Bairo</label>
      <div class="input-group has-validation">
        <input type="text" class="form-control" id="invalidCheck" required name="neighborhood" placeholder="Vila Nova">
        <div class="invalid-feedback">
          Porfavor Insira o Bairro.
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <label for="inputNomePet" class="form-label">Endereço</label>
      <div class="input-group has-validation">
        <input type="text" class="form-control" id="invalidCheck" required name="address" placeholder=" Rua: Joao Benedito">
        <div class="invalid-feedback">
          Porfavor Insira o Endereço.
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <label for="inputNomePet" class="form-label">Espécie</label>
      <div class="input-group has-validation">
        <select class="form-select" id="inputNomePet" name="species" required>
          @foreach ($species as $specie)
          <option value="{{ $specie->id }}">{{ $specie->name }}</option>
          @endforeach
        </select>
        <div class="invalid-feedback">
          Por favor, selecione a espécie.
        </div>
      </div>
    </div>


    <div class="col-md-6">
      <label for="inputNomePet" class="form-label">Raça</label>
      <div class="input-group has-validation">
        <input type="text" class="form-control" id="invalidCheck" required name="race">
        <div class="invalid-feedback">
          Porfavor Insira a raça.
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <label for="inputNomePet" class="form-label">Contato do tutor: Celular</label>
      <div class="input-group has-validation">
        <input type="text" class="form-control" id="invalidCheck" required name="contact" oninput="validateContact(this)" placeholder="(99)9 9999-9999">
        <div class="invalid-feedback">
          Por favor, insira o Contato com 11 dígitos.
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <label for="inputIdade" class="form-label">Nascimento</label>
      <div class="input-group has-validation">
        <input type="text" id="datepicker" name="birth" class="form-control" required readonly placeholder="dd/mm/YYYY">

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

    <div class="col-md-6">
      <label for="inputExercicio" class="form-label">O seu animal possui alguma rotina de exercício?
      </label>
      <select id="inputExercicio" class="form-select" name="exercise_routine">
        <option value=Muito_raro_sair_de_casa>Muito raro sair de casa</option>
        <option value=Somente_fins_de_semana>Somente fins de semana</option>
        <option value=Todos_os_dias_de_manhã>Todos os dias de manhã</option>
        <option value=Todos_os_dia_a_tarde>Todos os dias a tarde</option>
        <option value=Todos_os_dias_a_noite>Todos os dias a noite</option>
        <option value=Mais_de_uma_vez_por_dia>Mais de uma vez por dia</option>
        <option value=Tem_acesso_a_rua>Tem acesso a rua</option>
        <option value=Outro>Outro</option>
      </select>
    </div>
    <div class="col-md-6">
      <label for="inputReprodutiva" class="form-label">Vida reprodutiva</label>
      <select id="inputReprodutiva" class="form-select" name="reproductive_status">
        <option value=Macho>Macho</option>
        <option value=Femêa>Femêa</option>
        <option value=Interio>Interio</option>
        <option value=Castrado>Castrado</option>
        <option value=Em_reprodução>Em reprodução</option>
        <option value=Pretende_reproduzir>Pretende reproduzir</option>
        <option value=Já_reproduziu>Já reproduziu</option>
        <option value=Não_sabe_informar>Não sabe informar</option>
        <option value=Outro>Outro</option>
      </select>
    </div>

    <div class="col-md-4">
      <label for="inputPorte" class="form-label">Porte</label>
      <select id="inputPorte" class="form-select" name="size">
        <option value=Pequeno_porte>Pequeno porte</option>
        <option value=Medio_porte>Medio porte</option>
        <option value=Grande_porte>Grande Porte</option>
      </select>
    </div>

    <div class="col-md-4">
      <label for="inputPelo" class="form-label">Pelo ou Pena do animal</label>
      <select id="inputPelo" class="form-select" name="fur_length">
        <option value=Curto>Curto</option>
        <option value=Medio>Medio</option>
        <option value=Grande>Grande</option>
      </select>
    </div>

    <div class="col-md-4">
      <label for="inputProcedencia" class="form-label">Procedencia</label>
      <select id="inputProcedencia" class="form-select" name="origin">
        <option value=Adotado>Adotado</option>
        <option value=Comprado>Comprado</option>
        <option value=Filhote>Filhote</option>
        <option value=Outro selected>Outro</option>

      </select>
    </div>


    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
          Concorde com os termos e condições
        </label>
        <div class="invalid-feedback">
          Você deve concordar antes de cadastrar o animal.
        </div>
      </div>
    </div>


    <div class="col-12">
      <button type="submit" class="btn btn-outline-success" onclick="validateForm()">Cadastrar</button>
    </div>

  </form>

  <style>
    .row {
      width: 80%;
      margin: 0 auto;
    }

    .form-control,
    .form-select,
    .btn {
      margin-left: 10px;
      margin-right: 10px;
    }
  </style>

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
  <br><br>

</x-app-layout>