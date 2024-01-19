<?php

use App\Http\Controllers\AnimalsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalsUsers;
use App\Http\Controllers\DeletedController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\VaccinationsController;
use App\Http\Controllers\StatisticsController;
use App\Models\Events;

Route::prefix('/admin/animals')->group(function () {
    // CRUD VER 
    Route::get('/', [AnimalsController::class, 'index'])->name('animals-index');

    // CRUD ALTERAR
    Route::get('/{id}/edit', [AnimalsController::class, 'edit'])->where('id', '[0-9]+')->name('animals-edit');
    Route::put('/{id}', [AnimalsController::class, 'update'])->where('id', '[0-9]+')->name('animals-update');

    //inspecionar index
    Route::get('/{id}/inspect', [AnimalsController::class, 'inspeEdit'])->where('id', '[0-9]+')->name('inspeAdmin-inspect');

    //Vacinas
    Route::post('/vaccinations/store/{animalId?}', [VaccinationsController::class, 'store'])->name('vaccinations-store');

    Route::get('/vaccinations/{id}', [VaccinationsController::class, 'index'])->name('vaccinations-index');

    Route::delete('/vaccinations/destroy/{id}', [VaccinationsController::class, 'destroy'])->where('id', '[0-9]+')->name('vaccinations-destroy');


    // CRUD APAGAR
    Route::delete('/{id}', [AnimalsController::class, 'destroy'])->where('id', '[0-9]+')->name('animals-destroy');

    // PROCURAR
    Route::post('/', [AnimalsController::class, 'search'])->name('animals-search');

    Route::get('/search', [AnimalsController::class, 'search'])->name('animals-search');

    Route::get('/non-vaccinated/{page?}', [AnimalsController::class, 'showNonVaccinatedPaginated'])->name('animals-admin-filter-non-vaccinated');

    Route::get('/vaccinated/{page?}', [AnimalsController::class, 'showVaccinatedPaginated'])->name('animals-admin-filter-vaccinated');

    Route::get('/my-Animals/{page?}', [AnimalsController::class, 'myAnimals'])->name('animals-admin-filter-my-Animals');   
});



Route::prefix('/animals')->group(function () {
    // CRUD VER
    Route::get('/', [AnimalsUsers::class, 'index'])->name('animalsUsers-index');
    // CRUD CRIAR
    Route::get('/create', [AnimalsUsers::class, 'create'])->name('animalsUsers-create');
    Route::post('/', [AnimalsUsers::class, 'store'])->name('animalsUsers-store');

    // CRUD ALTERAR
    Route::get('/{id}/edit', [AnimalsUsers::class, 'edit'])->where('id', '[0-9]+')->name('animalsUsers-edit');
    Route::put('/{id}', [AnimalsUsers::class, 'update'])->where('id', '[0-9]+')->name('animalsUsers-update');

    //Vacinas
    Route::get('/{id}/vaccinations', [AnimalsUsers::class, 'indexVaccinations'])->where('id', '[0-9]+')->name('vaccinationsUsers-index');

    // CRUD APAGAR
    Route::delete('/{id}', [AnimalsUsers::class, 'destroy'])->where('id', '[0-9]+')->name('animalsUsers-destroy');
});

Route::prefix('/admin/users')->group(function () {
    // CRUD VER 
    Route::get('/', [UsuariosController::class, 'index'])->name('users-index');
    Route::get('/animals', [UsuariosController::class, 'indexAnimals'])->name('usersAnimals-index');
    Route::get('/Adminanimals', [UsuariosController::class, 'indexAdminAnimals'])->name('usersAdminAnimals-index');

    // PROCURAR
    Route::get('/search', [UsuariosController::class, 'search'])->name('users-search');
});

Route::fallback(function () {
    return "ERROR HTTP 400";
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {

    Route::get('/dashboard', [UsuariosController::class, 'dashboard'])->name('dashboard');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/eventos', [EventsController::class, 'showEvents'])->name('show-events');


//---------------------

Route::prefix('/events')->group(function () {


    Route::get('/', [EventsController::class, 'index'])->name('events-index');

    Route::get('/create', [EventsController::class, 'create'])->middleware('auth')->name('events-create');

    Route::get('/{id}', [EventsController::class, 'show']);

    Route::post('/', [EventsController::class, 'store']);

    Route::delete('/{id}', [EventsController::class, 'destroy'])->middleware('auth');

    Route::get('/edit/{id}', [EventsController::class, 'edit'])->middleware('auth');

    Route::put('/update/{id}', [EventsController::class, 'update'])->middleware('auth');

    Route::get('/create/dashboard', [EventsController::class, 'dashboard'])->middleware('auth')->name('events-dashboard');

    Route::post('/searchAdmin', [UsuariosController::class, 'searchAdmin'])->name('usersAdmin-search');
});

Route::middleware(['auth', 'role:admin'])->prefix('/admin')->group(function () {
    Route::get('/view', [UsuariosController::class, 'adminView'])->name('admin-view');
    Route::get('/panel', [UsuariosController::class, 'adminpanel'])->name('admin-panel');
    Route::get('/create', [UsuariosController::class, 'adminCreate'])->name('admin-create');
    Route::post('/store', [UsuariosController::class, 'adminStore'])->name('admin-store');
    Route::delete('/destroy/{id}', [UsuariosController::class, 'adminDestroy'])->where('id', '[0-9]+')->name('admin-destroy');
    //deleteds animal page
    Route::get('/deleteds', [DeletedController::class, 'adminDeleted'])->name('admin-deleted');
    Route::get('/deleteds/animals/vaccinations/{id}', [DeletedController::class, 'adminVaccinationsDeleteds'])->name('vaccinations-deleted');
    Route::delete('/deleteds/{id}', [DeletedController::class, 'AnimalDeleteddestroy'])->where('id', '[0-9]+')->name('animals-deleteds-destroy');
    Route::get('/deleteds/{id}/inspect', [DeletedController::class, 'AnimalDeletedInspect'])->where('id', '[0-9]+')->name('Animal-Deleted-inspect');
    Route::get('/deleteds/search', [DeletedController::class, 'searchDeleted'])->name('animals-search-deleteds');
    //deleteds vaccinations page
    Route::get('/deleteds/vaccinations/{id}/inspect', [DeletedController::class, 'VaccinationDeletedInspect'])->where('id', '[0-9]+')->name('Vaccination-Deleted-inspect');
    Route::delete('/deleteds/vaccinations/{id}', [DeletedController::class, 'VaccinationDeleteddestroy'])->where('id', '[0-9]+')->name('vaccination-deleteds-destroy');   
    Route::get('/deleteds/vaccinations/search', [DeletedController::class, 'searchVaccinationsDeleted'])->name('vaccinations-search-deleteds');






});


Route::prefix('/admin/statistics')->group(function () {

    Route::get('/', [StatisticsController::class, 'index'])->middleware('auth')->name('statistics-index');
});

Route::get('/rights', function () {
    return view('admin.rights');
})->name('rights-index');

Route::get('/rights/privacy', function () {
    return view('admin.privacyPolicy
    ');
})->name('privacy-policy');
