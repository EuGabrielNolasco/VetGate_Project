<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>VetGate</title>
        <link rel="icon" href="/img/logo.png" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://13fc-131-0-163-64.ngrok-free.app/build/assets/app-0958fbe4.css" />
<script type="module" src="https://13fc-131-0-163-64.ngrok-free.app/build/assets/app-ddee773b.js"></script>
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        @livewireStyles

        
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
    </head>
    <body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">

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
    <style>
        a {
            text-decoration: none !important;
        }
    </style>
</body>

</html>
