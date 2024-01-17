<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VetGate</title>
    <link rel="icon" href="/img/logo.png" type="image/png">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://13fc-131-0-163-64.ngrok-free.app/build/assets/app-0958fbe4.css" />
<script type="module" src="https://13fc-131-0-163-64.ngrok-free.app/build/assets/app-ddee773b.js"></script>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Scripts Boostrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <style>
        @media (max-width: 767px) {
            .pagination-container {
                text-align: left;
                justify-content: flex-start !important;
            }
        }

        @media (min-width: 768px) {
            .pagination-container {
                text-align: center;
                justify-content: center !important;
            }
        }

</style>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateContact(input) {
            // Remove qualquer caractere não numérico
            const numericValue = input.value.replace(/\D/g, '');

            // Verifica se o número de dígitos é diferente de 11
            if (numericValue.length !== 11) {
                input.setCustomValidity('O número deve ter exatamente 11 dígitos.');
            } else {
                input.setCustomValidity('');
            }

            // Atualiza o valor do campo para o valor numérico
            input.value = numericValue;
        }

        function previewImage(inputId, previewId) {
            var input = document.getElementById(inputId);
            var preview = document.getElementById(previewId);

            // Verifica se um arquivo foi selecionado
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Atualiza o atributo src da imagem de pré-visualização
                    preview.src = e.target.result;
                    // Exibe a imagem de pré-visualização
                    preview.style.display = 'block';
                };

                // Lê o arquivo como URL de dados
                reader.readAsDataURL(input.files[0]);
            } else {
                // Se nenhum arquivo foi selecionado, esconde a imagem de pré-visualização
                preview.style.display = 'none';
            }
        }
    </script>

    <style>
        a {
            text-decoration: none !important;
        }
    </style>


</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>

            {{ $slot }}

            <footer style="background-color: light;">
            <br><br>
                <div class="container text-center">
                    <p>
                        2023 Vet Gate &copy; | Todos os <a href="{{route('rights-index')}}">direitos</a> reservados.
                    </p>
                    <br>
                </div>
            </footer>
        </main>


    </div>



    @stack('modals')

    @livewireScripts
</body>

</html>