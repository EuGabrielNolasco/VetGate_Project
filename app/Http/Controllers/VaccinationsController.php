<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use Illuminate\Http\Request;
use App\Models\Animal;
use Illuminate\Support\Facades\Auth;


class VaccinationsController extends Controller
{
    public function index($id)
    {
        $user = Auth::user() ?? null;

        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $animal = Animal::findOrFail($id);

            // Buscar apenas as vacinas não deletadas
            $vaccinations = $animal->vaccinations()->where('deleted', 0)->get();

            return view('animalsAdmin.animalsVaccinations', ['animal' => $animal, 'vaccinations' => $vaccinations]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }


    public function store(Request $request, $animalId = null)
    {
        $user = Auth::user() ?? null;

        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $request->validate([
                'vaccine_name' => 'nullable',
                'vaccine_details' => 'nullable',
                'vaccine_date' => 'nullable|date_format:d/m/Y',
                'health_status' => 'nullable',
                'respiratory_rate' => 'nullable',
                'heart_rate' => 'nullable',
                'dewormed_status' => 'nullable',
                'date_dewormed' => 'nullable|date_format:d/m/Y',
                'vaccinated_status' => 'nullable',
            ]);

            $vaccinationData = $request->only([
                'vaccine_name',
                'vaccine_details',
                'vaccine_date',
                'health_status',
                'respiratory_rate',
                'heart_rate',
                'dewormed_status',
                'date_dewormed',
                'vaccinated_status',
            ]);

            $vaccinationData['contactante'] = auth()->user()->name;

            $vaccination = Vaccination::create(array_merge($vaccinationData, ['animal_id' => $animalId]));

            return redirect()->back()->with('animal_id', $animalId);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function destroy(int $id)
    {
        $user = Auth::user() ?? null;

        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {

            $vaccination = Vaccination::findOrFail($id);
            $vaccination->deleted = 1;
            $vaccination->save();
            return redirect()->route('animals-index')->with('status', 'delete');
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
}
