<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\DB;





class UsuariosController extends Controller
{
    public function index()
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;
    
        if ($userRole == 1) {
            $users = User::paginate(10); // Change the pagination as needed
            $animals = Animal::all();
    
            Paginator::useBootstrap(); // This line is important for Bootstrap pagination styling
    
            return view('admin.users', ['animals' => $animals, 'users' => $users]);
        } else {
            return view('dashboard');
        }
    }
    
    public function indexAnimals(Request $request)
    {
        $user = Auth::user();
        $animals = Animal::all();
        $userId = $request->input('id');

        if ($user && $user->role == 1) {

            foreach ($animals as $animal) {
                $dataNascimento = Carbon::createFromFormat('Y-m-d', $animal->birth);
                $idade = $dataNascimento->diffInYears(Carbon::now());
                $animal->idade = $idade;
                $quantidadeAnimaisCadastrados = Animal::count();
            }

            $user = User::findOrFail($userId);
            $animals = Animal::where('user_id', $userId)->get();

            return view('admin.usersAnimals', compact('user', 'animals'), ['animals' => $animals]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function indexAdminAnimals(Request $request)
    {
        $user = Auth::user();
        $animals = Animal::all();
        $userId = $request->input('id');

        if ($user && ($user->id == 1 || $user->id == $userId)) {
            $user = User::findOrFail($userId);
            $animals = Animal::where('user_id', $userId)->get();
        
            // Calcula a idade para cada animal
            foreach ($animals as $animal) {
                $dataNascimento = Carbon::createFromFormat('Y-m-d', $animal->birth);
                $idade = $dataNascimento->diffInYears(Carbon::now());
                $animal->idade = $idade;
            }
        
            $totalAnimais = $animals->count();
        
            return view('admin.usersAdminAnimals', compact('user', 'animals', 'totalAnimais'));
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
    
            // Use o "withQueryString" para anexar o termo de pesquisa aos links de paginação
            $users = User::where('name', 'like', "%$searchTerm%")->paginate(10)->withQueryString();
    
            return view('admin.users', compact('users'));
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    
    public function searchAdmin(Request $request)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;
        
        if ($userRole == 1) {
            // Código para pesquisar usuários aqui
            $searchTerm = $request->input('search');
            $users = User::where('name', 'like', "%$searchTerm%")->paginate(10)->withQueryString();
            
            return view('admin.usersAdmin', compact('users'));
        } else {
            // Código para lidar com outras situações (não role igual a 1)
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
        
    }
    
    public function adminStore(Request $request)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->id : null;

        if ($userRole == 1) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => '1',
            ]);

            Auth::guard('web')->loginUsingId($user->id);
            return redirect()->route('dashboard');
        } else {
            return view('dashboard');
        }
    }


    public function dashboard()
    {
        $quantidadeAnimaisCadastrados = Animal::count();

        return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
    }
    public function adminCreate()
    {
        $user = Auth::user() ?? null;
        $userId = $user ? $user->id : null;

        if ($userId == 1) {
            return view('admin.registerAdmin');
        } else {
            return view('dashboard');
        }
    }
    public function adminView()
    {
        $user = Auth::user() ?? null;
        $userId = $user ? $user->id : null;

        if ($userId == 1) {
            $userId = $user ? $user->id : null;
            $user = User::get();
            $users = User::all();
            $animal = Animal::get();
            $animals = Animal::all();

            return view('admin.usersAdmin', ['animals' => $animals, 'users' => $users]);
        } else {
            return view('dashboard');
        }
    }
    public function adminDestroy($id)
    {
        $user = Auth::user() ?? null;
        $userId = $user ? $user->id : null;

        if ($userId == 1) {
            $user = User::findOrFail($id);

            if ($user->animals->isNotEmpty()) {
                foreach ($user->animals as $animal) {
                    if ($animal->vaccinations->isNotEmpty()) {
                        foreach ($animal->vaccinations as $vacina) {
                            $vacina->delete();
                        }
                    }

                    $animal->delete();
                }
            }

            $user->delete();
            return redirect()->route('admin-view')->with('success', 'User and associated data deleted successfully');
        } else {
            return view('dashboard');
        }
    }
}
