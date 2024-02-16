<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{


    public function index()
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {

            $currentDate = Carbon::now();

            $months = collect([
                1 => 'Janeiro',
                2 => 'Fevereiro',
                3 => 'Março',
                4 => 'Abril',
                5 => 'Maio',
                6 => 'Junho',
                7 => 'Julho',
                8 => 'Agosto',
                9 => 'Setembro',
                10 => 'Outubro',
                11 => 'Novembro',
                12 => 'Dezembro',
            ]);

            $vaccinationMonthlyCounts = $months->map(function ($name, $month) use ($currentDate) {
                return [
                    'month' => $name,
                    'count' => DB::table('vaccinations')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', '>=', $currentDate->subMonths(12)->year)
                        ->count(),
                ];
            });
            $userMonthlyCounts = $months->map(function ($name, $month) use ($currentDate) {
                return [
                    'month' => $name,
                    'count' => DB::table('users')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', '>=', $currentDate->subMonths(12)->year)
                        ->count(),
                ];
            });

            $animalMonthlyCounts = $months->map(function ($name, $month) use ($currentDate) {
                return [
                    'month' => $name,
                    'count' => DB::table('animals')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', '>=', $currentDate->subMonths(12)->year)
                        ->count(),
                ];
            });

            $selectedYear = request()->get('year', $currentDate->year);

            $totalAnimais = Animal::count();
            $totalVacinas = Vaccination::count();
            $usuariosComAnimais = User::whereHas('animals')->count();
            $usuariosSemAnimais = User::count();
            $usuariosSemAnimais = $usuariosSemAnimais - $usuariosComAnimais;
            $animaisComVacinas = Animal::whereHas('vaccinations')->count();
            $animaisSemVacinas = $totalAnimais - $animaisComVacinas;

            return view('admin.statistics', compact('totalAnimais', 'animaisComVacinas', 'animaisSemVacinas', 'totalVacinas','usuariosComAnimais','usuariosSemAnimais' , 'userMonthlyCounts', 'animalMonthlyCounts', 'vaccinationMonthlyCounts', 'selectedYear', 'currentDate'));
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
}
