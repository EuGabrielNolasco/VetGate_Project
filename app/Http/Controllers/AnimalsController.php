<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;


use function PHPUnit\Framework\isEmpty;

class AnimalsController extends Controller
{

    public function filterAnimals()
    {
        $user = Auth::user();
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            return redirect()->route('animals-index')->with('show_user_animals_only', true);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function showNonVaccinatedPaginated()
    {
        $user = Auth::user();
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $nonVaccinatedAnimals = Animal::where('deleted', 0)
            ->doesntHave('vaccinations')
            ->paginate(20);
        
            return view('animalsAdmin.animalsAdmin', ['animals' => $nonVaccinatedAnimals]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function showVaccinatedPaginated()
    {
        $user = Auth::user();
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $vaccinatedAnimals = Animal::where('deleted', 0)
            ->has('vaccinations')->paginate(20);

            return view('animalsAdmin.animalsAdmin', ['animals' => $vaccinatedAnimals]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    public function myAnimals()
    {
        $user = Auth::user();
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {

            $userId = $user ? $user->id : null;
            $myAnimals = Animal::where('deleted', 0)
            ->where('user_id', $userId)->paginate(20);

            return view('animalsAdmin.animalsAdmin', ['animals' => $myAnimals]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    public function index()
    {
        $user = Auth::user();
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $userId = $user ? $user->id : null;

            // Modifique a consulta para usar paginate
            $animals = Animal::where('deleted', 0)
            ->where('user_id', $userId)->paginate(20); // 10 é o número de itens por página

            return view('animalsAdmin.animalsAdmin', ['animals' => $animals]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function edit(string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $userId = $user ? $user->id : null;
            $users = User::all();
            $vaccines = Vaccination::all();
            $animal = Animal::find($id);
            if (!empty($animal)) {
                return view('animalsAdmin.animalsAdminEdit', ['animal' => $animal, 'user' => $user], ['vaccines' => $vaccines]);
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

        if ($userRole == 1) {
            $dataNascimento = Carbon::createFromFormat('d/m/Y', $request->input('date_dewormed'));


            $request->validate([
                'contactante' => 'nullable|max:255',
                'date_dewormed' => 'nullable|max:255',
                'dewormed_status' => 'nullable|max:255',
                'vaccinated_status' => 'nullable|max:255',
                'health_status' => 'nullable|max:255',
                'respiratory_rate' => 'nullable|max:255',
                'heart_rate' => 'nullable|max:255',
            ]);

            $animal = Animal::find($id);
            $dadosAnimal = $request->all();

            if (isEmpty(request('contactante'))) {
                $dadosAnimal['contactante'] = $user->name;
            }

            $dadosAnimal['date_dewormed'] = $dataNascimento->format('Y-m-d');
            $animal->update($dadosAnimal);

            return redirect()->route('animals-index')->with('status', 'update');
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }


    public function destroy(string $id)
{
    $user = Auth::user() ?? null;
    $userRole = $user ? $user->role : null;

    if ($userRole == 1) {
        $animal = Animal::findOrFail($id);

        // Remover a associação entre o animal e o usuário
        $animal->deleted = 1;
        $animal->user_id = null;
        $animal->save();

        // Verificar e atualizar as vacinas associadas ao animal
        if ($animal->vaccinations->isNotEmpty()) {
            foreach ($animal->vaccinations as $vaccination) {
                $vaccination->deleted = 1;
                $vaccination->save();
            }
        }

        return redirect()->route('animals-index')->with('status', 'delete');
    } else {
        $quantidadeAnimaisCadastrados = Animal::count();
        return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
    }
}

    


    public function search(Request $request)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;
    
        if ($userRole == 1) {
            $searchTerm = $request->input('search');
    
            // Modifique a consulta para usar paginate
            $animals = Animal::where('deleted', 0)
            ->where('id', 'like', "%$searchTerm%")->paginate(20); // 20 é o número de itens por página
    
            return view('animalsAdmin.animalsAdmin', compact('animals'));
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
    
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    

    public function inspeEdit(string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {

            $animal = Animal::where('deleted', 0)
            ->find($id);
            if (!empty($animal)) {
                return view('animalsAdmin.animalsAdminInspe', ['animal' => $animal]);
            } else {
                return redirect()->route('animalsAdmin-index');
            }
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
}
