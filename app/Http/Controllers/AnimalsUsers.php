<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Species;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use League\CommonMark\Exception\IOException;

class AnimalsUsers extends Controller
{

    public function index()
    {
        $user = Auth::user() ?? null;
        $animals = Animal::all();
        $userRole = $user ? $user->role : null;

        if ($userRole == 0 || $userRole == 1) {

            foreach ($animals as $animal) {
                $dataNascimento = Carbon::createFromFormat('Y-m-d', $animal->birth);
                $idade = $dataNascimento->diffInYears(Carbon::now());
                $animal->idade = $idade;
            }

            $userId = $user ? $user->id : null;
            $animals = Animal::where('deleted', 0)
                ->where('user_id', $userId)->get();

            return view('animalsUsers.animals', ['animals' => $animals]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function create()
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 0 || $userRole == 1) {
            $users = User::all();
            $species = Species::all();
            $countAnimal = Animal::where('user_id', Auth::user()->id)->count();

            return view('animalsUsers.animalsCreate', [
                'users' => $users,
                'count' => $countAnimal,
                'loggedInUser' => $user,
                'species' => $species,
            ]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 0 || $userRole == 1) {
            try {
                $dataNascimento = Carbon::createFromFormat('d/m/Y', $request->input('birth'));
            } catch (\Exception $e) {
                // A conversão falhou, retorne uma resposta adequada
                return redirect()->back()->withErrors(['birth' => 'Formato de data inválido. Use o formato dd/mm/yyyy.']);
            }

            $dadosAnimal = $request->all();
            $dadosAnimal['birth'] = $dataNascimento->format('Y-m-d');
            $dadosAnimal['user_id'] = $user->id;
            $dadosAnimal['owner_name'] = $user->name;
            $dadosAnimal['species'] = Species::where('id', $request->input('species'))->value('name');
            $countAnimal = Animal::where('user_id', Auth::user()->id)->count();

            if ($countAnimal < 10 || $userRole == 1) {
                Animal::create($dadosAnimal);
            } else {
                return redirect()->route('animals-index')->with('status', 'failed');
            }

            return redirect()->route('animals-index')->with('status', 'create');
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 0 || $userRole == 1) {

            $animal = Animal::find($id);
            if (!empty($animal)) {
                return view('animalsUsers.animalsEdit', ['animal' => $animal]);
            } else {
                return redirect()->route('animals-index');
            }
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    public function update(Request $request, string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 0 || $userRole == 1) {
            $request->validate([
                'name' => 'nullable|max:255',
                'owner_name' => 'nullable|max:255',
                'address' => 'nullable|max:255',
                'contact' => 'nullable|max:255',
                'species' => 'nullable|max:255',
                'race' => 'nullable|max:255',
                'exercise_routine' => 'nullable|max:255',
                'reproductive_status' => 'nullable|max:255',
                'dewormed_status' => 'nullable|max:255',
                'vaccinated_status' => 'nullable|max:255',
                'size' => 'nullable|max:255',
                'fur_length' => 'nullable|max:255',
                'origin' => 'nullable|max:255',
                'health_status' => 'nullable|max:255',
                'respiratory_rate' => 'nullable|max:255',
                'heart_rate' => 'nullable|max:255',
            ]);
            $animal = Animal::find($id);
            $dadosAnimal = $request->all();
            $animal->update($dadosAnimal);

            return redirect()->route('animals-index')->with('status', 'update');
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function indexVaccinations(string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 0 || $userRole == 1) {

            $animal = Animal::findOrFail($id);
            $vaccinations = $animal->vaccinations;

            return view('animalsUsers.inspeAnimals', ['animal' => $animal, 'vaccinations' => $vaccinations]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function destroy(string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 0 || $userRole == 1) {

            $animal = Animal::findOrFail($id);
            $animal->deleted = 1;
            $animal->user_id = null;
            $animal->save();

            return redirect()->route('animals-index')->with('status', 'delete');
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
}
