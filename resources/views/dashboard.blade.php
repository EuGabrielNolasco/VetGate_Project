<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Inicio') }}

    </h2>
  </x-slot>
  
  <div id="meuCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('img/carousel1.jpg') }}" class="d-block w-100" alt="Imagem 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/carousel2.jpg') }}" class="d-block w-100" alt="Imagem 2">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/carousel3.jpg') }}" class="d-block w-100" alt="Imagem 3">
      </div>
    </div>

    <!-- Botões de navegação -->
    <button class="carousel-control-prev" type="button" data-bs-target="#meuCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#meuCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Próximo</span>
    </button>
  </div>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <h1 class="mt-2 text-lg font-medium text-gray-500 text-center">
        Ja somos mais de
        <span class="text-green-400 text-xl m2-4">•</span>
        {{ $quantidadeAnimaisCadastrados }} animais cadastrados
      </h1>
      <br>
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">



        <x-welcome />
      </div>
    </div>
  </div>

</x-app-layout>