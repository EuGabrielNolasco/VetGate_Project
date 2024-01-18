<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacinações de ') . $animal->name }}
        </h2>
    </x-slot>
    <div class="container mt-3">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <button type="button" class="btn btn-warning" onclick="goBack()">Voltar</button>
        </div>

        <div class="accordion" id="accordionVaccinations">
            <br>
            @foreach($vaccinations as $vaccination)
            <div class="accordion-item">
                <h2 class="accordion-header" id="vaccinationHeading{{ $vaccination->id }}">

                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#vaccinationCollapse{{ $vaccination->id }}" aria-expanded="true" aria-controls="vaccinationCollapse{{ $vaccination->id }}">
                        {{ \Carbon\Carbon::parse($vaccination->created_at)->locale('pt_BR')->isoFormat('dddd, D [de] MMMM [de] YYYY H:mm:s') }}
                    </button>

                </h2>
                <div id="vaccinationCollapse{{ $vaccination->id }}" class="accordion-collapse collapse" aria-labelledby="vaccinationHeading{{ $vaccination->id }}">
                    <div class="accordion-body">
                        <strong>Id:</strong> {{ $vaccination->id }}<br>
                        <strong>Contactante:</strong> {{ $vaccination->contactante }}<br>
                        <strong>Vermifugação:</strong> {{ $vaccination->dewormed_status }}<br>
                        <strong>Ultima Vermifugação:</strong> {{ $vaccination->date_dewormed }}<br>
                        <strong>Vacinação</strong> {{ $vaccination->vaccinated_status }}<br>
                        <strong>Saude:</strong> {{ $vaccination->health_status }}<br>
                        <strong>Frequencia Respiratoria:</strong> {{ $vaccination->respiratory_rate }}<br>
                        <strong>Frequência Cardíaca:</strong> {{ $vaccination->heart_rate }}<br><br>
                        <form action="{{ route('vaccinations-destroy', $vaccination->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja excluir esta vacinação permanetemente?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>