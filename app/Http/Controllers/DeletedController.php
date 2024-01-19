<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Animal;
use App\Models\Vaccination;
use Carbon\Carbon;
use App\Models\User;

class DeletedController extends Controller  
{
    
    public function adminDeleted()
    {
        $user = Auth::user();
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {

            $animals = Animal::where('deleted', 1)
           ->paginate(8); 
            $vaccinations = Vaccination::where('deleted', 1)
           ->paginate(8); 

            return view('deleteds.deletedAdmin', ['animals' => $animals, 'vaccinations' => $vaccinations]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    public function adminVaccinationsDeleteds($id)
    {
        $user = Auth::user() ?? null;

        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $animal = Animal::findOrFail($id);

            // Buscar apenas as vacinas não deletadas
            $vaccinations = $animal->vaccinations()->where('deleted', 1)->get();

            return view('deleteds.deletedVaccinationsAdmin', ['animal' => $animal, 'vaccinations' => $vaccinations]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    public function AnimalDeleteddestroy(string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;
    
        if ($userRole == 1) {
            $animal = Animal::with('vaccinations')->findOrFail($id);
    
            // Remover a associação entre o animal e o usuário
            $animal->user_id = null;
            $animal->save();
    
            // Desvincular o animal de todas as vacinas
            if ($animal->vaccinations->isNotEmpty()) {
                foreach ($animal->vaccinations as $vaccination) {
                    $vaccination->animal_id = null;
                    $vaccination->save();
                }
            }
    
            // Excluir permanentemente o animal do banco de dados
            $animal->forceDelete();
    
            return redirect()->route('admin-deleted')->with('status', 'delete');
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function AnimalDeletedInspect(string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {

            $animal = Animal::where('deleted', 1)
            ->find($id);
            if (!empty($animal)) {
                return view('deleteds.deletedInspectAdmin', ['animal' => $animal]);
            } else {
                return redirect()->route('admin-deleted');
            }
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function searchDeleted(Request $request)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;
    
        if ($userRole == 1) {
            $searchTerm = $request->input('search');
    
            // Modifique a consulta para usar paginate
            $animals = Animal::where('deleted', 1)
            ->where('id', 'like', "%$searchTerm%")->paginate(8); 

            $vaccinations = Vaccination::where('deleted', 1)
            ->paginate(8); 
    
            return view('deleteds.deletedAdmin', ['animals' => $animals, 'vaccinations' => $vaccinations]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
    
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function VaccinationDeletedInspect(string $id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {

            $vaccination = Vaccination::where('deleted', 1)
            ->find($id);
            if (!empty($vaccination)) {
                return view('deleteds.deletedInspectVaccinationsAdmin', ['vaccination' => $vaccination]);
            } else {
                return redirect()->route('admin-deleted');
            }
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function VaccinationDeleteddestroy(string $vaccinationId)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;
    
        if ($userRole == 1) {
            $vaccination = Vaccination::findOrFail($vaccinationId);
    
            // Excluir permanentemente a vacina do banco de dados
            $vaccination->forceDelete();
    
            return redirect()->route('admin-deleted')->with('status', 'delete');
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function searchVaccinationsDeleted(Request $request)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;
    
        if ($userRole == 1) {
            $searchTerm = $request->input('search');
    
            // Modifique a consulta para usar paginate
            $vaccinations = Vaccination::where('deleted', 1)
            ->where('id', 'like', "%$searchTerm%")->paginate(8); 

            $animals = Animal::where('deleted', 1)
            ->paginate(8); 
    
            return view('deleteds.deletedAdmin', ['animals' => $animals, 'vaccinations' => $vaccinations]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
    
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    
}
