@auth
<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Termos de Serviço') }}
        </h2>
    </x-slot><br>
    <div class="container mt-1">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
      <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
    </div>
        <br><br>
        <h3>Termos de Serviço</h3>

        <p>Bem-vindo aos Termos de Serviço do Vet Gate!</p>

        <p>
            Ao acessar ou usar o site Vet Gate, você concorda com estes termos de serviço.
            Leia atentamente. Se você não concordar com esses termos, por favor, não use o site.
        </p>

        <h4>1. Uso do Site</h4>

        <p>
            Você concorda em usar o site Vet Gate apenas para fins legais e de maneira que não viole os
            direitos de outros, prejudique ou interfira na capacidade do site de fornecer seus serviços.
        </p>

        <h4>2. Conteúdo do Usuário</h4>

        <p>
            Os usuários podem contribuir com conteúdo para o site. Ao fazer isso, você concede ao Vet Gate
            uma licença mundial, não exclusiva, royalty-free, que pode ser sublicenciada e transferida,
            para usar, reproduzir, modificar, adaptar, publicar, distribuir e exibir esse conteúdo.
        </p>

        <h4>3. Privacidade</h4>

        <p>
            Nós respeitamos a privacidade dos nossos usuários. Consulte nossa
            <a href="{{ route('privacy-policy') }}">Política de Privacidade</a> para obter informações detalhadas
            sobre como tratamos suas informações pessoais.
        </p>

        <h4>4. Modificações nos Termos</h4>

        <p>
            Reservamos o direito de modificar estes Termos de Serviço a qualquer momento. As modificações
            entram em vigor imediatamente após serem publicadas no site. O uso contínuo do site após
            modificações constitui aceitação dos novos termos.
        </p>

        <h4>Contate-nos</h4>

        <p>
            Se você tiver alguma dúvida sobre estes Termos de Serviço, entre em contato conosco em
            <a href="mailto:contato@vetgate.com">contato@vetgate.com</a>.
        </p>
    </div>
</x-app-layout>
@else
<x-guest-layout>
@if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
            <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Painel</a>
        @else
            <a href="{{ route('show-events') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Eventos&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Conecte-se</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registro</a>
            @endif
        @endauth
    </div>
@endif
<br><br><br>

    <div class="container mt-1">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
      <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
    </div>
        <br><br>
        <h3>Termos de Serviço</h3>

        <p>Bem-vindo aos Termos de Serviço do Vet Gate!</p>

        <p>
            Ao acessar ou usar o site Vet Gate, você concorda com estes termos de serviço.
            Leia atentamente. Se você não concordar com esses termos, por favor, não use o site.
        </p>

        <h4>1. Uso do Site</h4>

        <p>
            Você concorda em usar o site Vet Gate apenas para fins legais e de maneira que não viole os
            direitos de outros, prejudique ou interfira na capacidade do site de fornecer seus serviços.
        </p>

        <h4>2. Conteúdo do Usuário</h4>

        <p>
            Os usuários podem contribuir com conteúdo para o site. Ao fazer isso, você concede ao Vet Gate
            uma licença mundial, não exclusiva, royalty-free, que pode ser sublicenciada e transferida,
            para usar, reproduzir, modificar, adaptar, publicar, distribuir e exibir esse conteúdo.
        </p>

        <h4>3. Privacidade</h4>

        <p>
            Nós respeitamos a privacidade dos nossos usuários. Consulte nossa
            <a href="{{ route('privacy-policy') }}">Política de Privacidade</a> para obter informações detalhadas
            sobre como tratamos suas informações pessoais.
        </p>

        <h4>4. Modificações nos Termos</h4>

        <p>
            Reservamos o direito de modificar estes Termos de Serviço a qualquer momento. As modificações
            entram em vigor imediatamente após serem publicadas no site. O uso contínuo do site após
            modificações constitui aceitação dos novos termos.
        </p>

        <h4>Contate-nos</h4>

        <p>
            Se você tiver alguma dúvida sobre estes Termos de Serviço, entre em contato conosco em
            <a href="mailto:contato@vetgate.com">contato@vetgate.com</a>.
        </p>
    </div>
</x-guest-layout>
@endauth
