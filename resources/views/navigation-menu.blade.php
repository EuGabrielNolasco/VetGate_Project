<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Menu de Navegação Primária -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logotipo -->
                <div class="shrink-0 flex items-center">
                    <a href="/dashboard">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Links de Navegação -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="/dashboard" :active="request()->routeIs('dashboard')">
                        {{ __('Início') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ Route('events-index') }}" :active="request()->routeIs('events-index')">
                        {{ __('Eventos') }}
                    </x-nav-link>
                </div>

                @php
                // Obtém o usuário autenticado
                $user = Auth::user() ?? null;

                // Verifica se o usuário está autenticado antes de acessar a propriedade role
                $userRole = $user ? $user->role : null;
                @endphp

                @if($userRole == 1)
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{route('events-create')}}" :active="request()->routeIs('events-create')">
                        {{ __('Admin') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{route('statistics-index')}}" :active="request()->routeIs('statistics-index')">
                        {{ __('Estatísticas') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ Route('animals-index') }}" :active="request()->routeIs('animals-index')">
                        {{ __('Animais') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('users-index') }}" :active="request()->routeIs('users-index')">
                        {{ __('Usuários') }}
                    </x-nav-link>
                </div>
                @endif

                @if($userRole == 0)
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ Route('animalsUsers-create') }}" :active="request()->routeIs('animalsUsers-create')">
                        {{ __('Cadastrar Animais') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ Route('animalsUsers-index') }}" :active="request()->routeIs('animalsUsers-index')">
                        {{ __('Meus Animais') }}
                    </x-nav-link>
                </div>
                @endif
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Dropdown de Equipes -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ Auth::user()->currentTeam->name }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Gerenciamento de Equipe -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Gerenciar Equipe') }}
                                </div>

                                <!-- Configurações de Equipe -->
                                <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Configurações da Equipe') }}
                                </x-dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Criar Nova Equipe') }}
                                </x-dropdown-link>
                                @endcan

                                <!-- Alternador de Equipe -->
                                @if (Auth::user()->allTeams()->count() > 1)
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Alternar Equipes') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" />
                                @endforeach
                                @endif
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endif

                <!-- Dropdown de Configurações -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    @if (Auth::check())
                                    {{ Auth::user()->name }}
                                    @endif
                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Gerenciamento de Conta -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Gerenciar Conta') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Perfil') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('Tokens de API') }}
                            </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Autenticação -->
                            <form method="POST" action="{{ secure_url('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ secure_url('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Sair') }}
                                </x-dropdown-link>
                            </form>

                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hambúrguer -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu de Navegação Responsivo -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Início') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('events-index') }}" :active="request()->routeIs('events-index')">
                {{ __('Eventos') }}
            </x-responsive-nav-link>
        </div>

        @php
        // Obtém o usuário autenticado
        $user = Auth::user() ?? null;

        // Verifica se o usuário está autenticado antes de acessar a propriedade role
        $userRole = $user ? $user->role : null;
        @endphp

        @if($userRole == 1)
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{route('events-create')}}" :active="request()->routeIs('events-create')">
                {{ __('Admin') }}
            </x-responsive-nav-link>

        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{route('statistics-index')}}" :active="request()->routeIs('statistics-index')">
                {{ __('Estatisticas') }}
            </x-responsive-nav-link>

        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ Route('animals-index') }}" :active="request()->routeIs('animals-index')">
                {{ __('Animais') }}

            </x-responsive-nav-link>

        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('users-index') }}" :active="request()->routeIs('users-index')">
                {{ __('Usuarios') }}

            </x-responsive-nav-link>


        </div>
        @endif

        @if($userRole == 0)

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ Route('animalsUsers-create') }}" :active="request()->routeIs('animalsUsers-create')">
                {{ __('Cadastrar Animais') }}

            </x-responsive-nav-link>

        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ Route('animalsUsers-index') }}" :active="request()->routeIs('animalsUsers-index')">
                {{ __('Meus Animais') }}

            </x-responsive-nav-link>
        </div>

        @endif


        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 me-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ secure_url('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ secure_url('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Sair') }}
                    </x-responsive-nav-link>
                </form>


                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-responsive-nav-link>
                @endcan

                <!-- Team Switcher -->
                @if (Auth::user()->allTeams()->count() > 1)
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-switchable-team :team="$team" component="responsive-nav-link" />
                @endforeach
                @endif
                @endif
            </div>
        </div>
    </div>
</nav>