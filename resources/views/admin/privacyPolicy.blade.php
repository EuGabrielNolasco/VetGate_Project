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
        <h3>Política de Privacidade</h3>

        <p>Bem-vindo à Política de Privacidade do Vet Gate!</p>

        <p>
            Esta Política de Privacidade descreve como coletamos, usamos, compartilhamos e protegemos suas informações
            pessoais quando você utiliza nosso site. Ao utilizar o Vet Gate, você concorda com as práticas descritas
            nesta política.
        </p>

        <h4>1. Informações que Coletamos</h4>

        <p>
            Podemos coletar informações pessoais que você fornece voluntariamente ao usar o Vet Gate. Isso pode incluir
            informações como nome, endereço de e-mail e outras informações de contato.
        </p>

        <h4>2. Uso das Informações</h4>

        <p>
            Utilizamos as informações coletadas para fornecer, manter, proteger e melhorar nossos serviços, além de
            desenvolver novos serviços. Também podemos usar essas informações para personalizar os serviços e oferecer
            conteúdo relevante para você.
        </p>

        <h4>3. Compartilhamento de Informações</h4>

        <p>
            Não compartilhamos suas informações pessoais com terceiros, exceto quando necessário para operar nossos
            serviços ou conforme exigido por lei.
        </p>

        <h4>4. Cookies e Tecnologias Semelhantes</h4>

        <p>
            Utilizamos cookies e tecnologias semelhantes para melhorar a experiência do usuário, personalizar conteúdo
            e anúncios, fornecer recursos de mídia social e analisar o tráfego no site.
        </p>

        <h4>5. Segurança</h4>

        <p>
            Implementamos medidas de segurança para proteger suas informações pessoais contra acesso não autorizado ou
            divulgação.
        </p>

        <h4>6. Alterações nesta Política</h4>

        <p>
            Reservamo-nos o direito de atualizar esta Política de Privacidade periodicamente. Recomendamos que você
            reveja regularmente esta política para estar ciente de qualquer modificação.
        </p>

        <h4>Contate-nos</h4>

        <p>
            Se você tiver alguma dúvida sobre nossa Política de Privacidade, entre em contato conosco em
            <a href="mailto:privacidade@vetgate.com">privacidade@vetgate.com</a>.
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
        <h3>Política de Privacidade</h3>

        <p>Bem-vindo à Política de Privacidade do Vet Gate!</p>

        <p>
            Esta Política de Privacidade descreve como coletamos, usamos, compartilhamos e protegemos suas informações
            pessoais quando você utiliza nosso site. Ao utilizar o Vet Gate, você concorda com as práticas descritas
            nesta política.
        </p>

        <h4>1. Informações que Coletamos</h4>

        <p>
            Podemos coletar informações pessoais que você fornece voluntariamente ao usar o Vet Gate. Isso pode incluir
            informações como nome, endereço de e-mail e outras informações de contato.
        </p>

        <h4>2. Uso das Informações</h4>

        <p>
            Utilizamos as informações coletadas para fornecer, manter, proteger e melhorar nossos serviços, além de
            desenvolver novos serviços. Também podemos usar essas informações para personalizar os serviços e oferecer
            conteúdo relevante para você.
        </p>

        <h4>3. Compartilhamento de Informações</h4>

        <p>
            Não compartilhamos suas informações pessoais com terceiros, exceto quando necessário para operar nossos
            serviços ou conforme exigido por lei.
        </p>

        <h4>4. Cookies e Tecnologias Semelhantes</h4>

        <p>
            Utilizamos cookies e tecnologias semelhantes para melhorar a experiência do usuário, personalizar conteúdo
            e anúncios, fornecer recursos de mídia social e analisar o tráfego no site.
        </p>

        <h4>5. Segurança</h4>

        <p>
            Implementamos medidas de segurança para proteger suas informações pessoais contra acesso não autorizado ou
            divulgação.
        </p>

        <h4>6. Alterações nesta Política</h4>

        <p>
            Reservamo-nos o direito de atualizar esta Política de Privacidade periodicamente. Recomendamos que você
            reveja regularmente esta política para estar ciente de qualquer modificação.
        </p>

        <h4>Contate-nos</h4>

        <p>
            Se você tiver alguma dúvida sobre nossa Política de Privacidade, entre em contato conosco em
            <a href="mailto:privacidade@vetgate.com">privacidade@vetgate.com</a>.
        </p>
    </div>
</x-guest-layout>
@endauth