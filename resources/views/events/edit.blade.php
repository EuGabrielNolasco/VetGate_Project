<?php

use Carbon\Carbon;

?>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Editar Eventos') }}
    </h2>
  </x-slot>
  <div class="container mt-5">
  <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
        </div>
    <div class="col-md-6 offset-md-3">

      <h1>Editando: {{ $event->title }}</h1>
      <form action="/events/update/{{ $event->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
<br>
        <div class="form-group">
          <label for="image">Imagem do Evento:</label>
          <input class="form-control" type="file" id="image" name="image" required onchange="previewImage('image', 'image-preview')"><br>
          <img id="image-preview" src="#" alt="Imagem de pré-visualização" class="img-preview" style="display: none;">
        </div>

        <div class="form-group">
          <br>
          <label for="title">Evento:</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{ $event->title }}">
        </div>

        <br>

        <div class="form-group">
          <label for="date">Data do evento:</label>
          <div class="input-group has-validation">
            <input type="text" id="datepicker" name="date" class="form-control" required readonly placeholder="dd/mm/YYYY" value="{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}">

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

        <div class="form-group">
          <label for="city">Cidade:</label>
          <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" value="{{ $event->city }}">
        </div>
        <br>
        <div class="form-group">
          <label for="title">O evento é privado?</label>
          <select name="private" id="private" class="form-control">
            <option value="0">Não</option>
            <option value="1" {{ $event->private == 1 ? "selected='selected'" : "" }}>Sim</option>
          </select>
        </div>
        <br>
        <div class="form-group">
          <label for="title">Descrição:</label>
          <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?" style="resize: none">{{ $event->description }}</textarea>
        </div>
        <br>
        <div class="form-group">
          <label for="title">Adicione itens de infraestrutura:</label>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
          </div>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Palco"> Palco
          </div>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Vacinas Gratis"> Vacinas Gratis
          </div>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Bebida grátis"> Bebida grátis
          </div>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Open food"> Open food
          </div>
          <div class="form-group">
            <input type="checkbox" name="items[]" value="Brindes"> Brindes
          </div>
        </div><br>
        <input type="submit" class="btn btn-primary mx-auto d-block" value="Editar Evento">
      </form>
    </div>
  </div>

  <br>

</x-app-layout>