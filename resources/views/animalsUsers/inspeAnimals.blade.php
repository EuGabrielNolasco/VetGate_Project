<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vacinações de ') . $animal->name }}
        </h2>
    </x-slot><br>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Ola!</strong> Leve seu animal para algum <a href="/events">evento</a> programado para regularizar suas vacinas!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
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
                    <strong>Contactante:</strong> {{ $vaccination->contactante}}<br>
                    <strong>Vermifugação:</strong> {{ $vaccination->dewormed_status }}<br>
                    <strong>Ultima Vermifugação:</strong> {{ $vaccination->date_dewormed }}<br>
                    <strong>Vacinação</strong> {{ $vaccination->vaccinated_status }}<br>
                    <strong>Saude:</strong> {{ $vaccination->health_status }}<br>
                    <strong>Frequencia Respiratoria:</strong> {{ $vaccination->respiratory_rate }}<br>
                    <strong>Frequência Cardíaca:</strong> {{ $vaccination->heart_rate }}<br><br>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>

</x-app-layout>