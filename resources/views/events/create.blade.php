<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Painel Admin') }}
    </h2>
  </x-slot>
  <br>
  <div id="event-create-container" class="col-md-6 offset-md-3">
    @if(auth()->user()->id == 1)
    <div class="card col-sm-12">
      <div class="card-body">
        <h5 class="card-title">Gerenciar Admins</h5>
        <p class="card-text">Clique no botão abaixo para criar um admin e gerenciar os atuais.</p>
        <a href="{{ route('admin-create') }}" class="btn btn-success">Gerenciar Admin</a>
      </div>
    </div>
    @endif
    <div class="card col-sm-12 mt-3">
      <div class="card-body">
        <h5 class="card-title">Editar Eventos</h5>
        <p class="card-text">Clique no botão abaixo para editar eventos.</p>
        <a href="{{ route('events-dashboard') }}" class="btn btn-primary">Editar Eventos</a>
      </div>
    </div>
  </div>

  <div class="container mt-5">

    <div id="event-create-container" class="col-md-6 offset-md-3">

      <h1>Crie o seu evento</h1>
      <br>
      <form action="/events" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="image">Imagem do Evento:</label>
          <input class="form-control" type="file" id="image" name="image" required onchange="previewImage('image', 'image-preview')"><br>
          <img id="image-preview" src="#" alt="Imagem de pré-visualização" class="img-preview" style="display: none;">
        </div>
        <br>

        <div class="form-group">
          <label for="title">Evento:</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" required>
        </div>
        <br>

        <div class="form-group">
          <label for="date">Data do evento:</label>
          <div class="input-group has-validation">
            <input type="text" id="datepicker" name="date" class="form-control" required readonly placeholder="dd/mm/YYYY">
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

        <div class="form-group">
          <label for="city">Cidade:</label>
          <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" required>
        </div>
        <br>

        <div class="form-group">
          <label for="private">O evento é privado?</label>
          <select name="private" id="private" class="form-control" required>
            <option value="0">Não</option>
            <option value="1">Sim</option>
          </select>
        </div>
        <br>

        <div class="form-group">
          <label for="description">Descrição:</label>
          <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?" style="resize: none" required></textarea>
        </div>
        <br>

        <div class="form-group">
          <label for="items">Adicione itens de infraestrutura:</label>
          <br><br>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
          </div>
          <br>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Vacinas Gratis"> Vacinas Gratis
          </div>
          <br>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Palco"> Palco
          </div>
          <br>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Bebida grátis"> Bebida grátis
          </div>
          <br>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Open food"> Open food
          </div>
          <br>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Brindes"> Brindes
          </div>
          <br>
        </div>

        <input type="submit" class="btn btn-primary btn-lg mx-auto d-block" value="Criar Evento">
      </form>
      <br><br>
    </div>
  </div>
  <br>

</x-app-layout>