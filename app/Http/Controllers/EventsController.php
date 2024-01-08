<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Events;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Support\Carbon;

class EventsController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $events = Events::where([
                ['title', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $events = Events::all();
        }
        foreach ($events as $event) {
            $event->time_elapsed = $event->created_at->diffForHumans();
        }

        return view('events.events', ['events' => $events, 'search' => $search]);
    }


    public function create()
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $user = Auth::user() ?? null;
            $userRole = $user ? $user->role : null;

            if ($userRole == 1) {
                return view('events.create');
            } else {
                $quantidadeAnimaisCadastrados = Animal::count();
                return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
            }
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {

            try {
                $data = Carbon::createFromFormat('d/m/Y', $request->input('date'));
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['date' => 'Formato de data inválido. Use o formato dd/mm/yyyy.']);
            }

            $event = new Events;

            $event->title = $request->title;
            $event->date =  $data;
            $event->city = $request->city;
            $event->private = $request->private;
            $event->description = $request->description;
            $event->items =  $request->items;

            // Image Upload

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestImage->move(public_path('img/events'), $imageName);
                $event->image = $imageName;
            }
            $user = auth()->user();
            $event->user_id = $user->id;
            $event->save();

            return redirect('/events')->with('msg', 'Evento criado com sucesso!');
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function show($id)
    {
        $event = Events::findOrFail($id);
        $user = auth()->user();
        $hasUserJoined = false;

        // Verifique se o usuário do evento existe
        $eventOwner = User::find($event->user_id);

        // Se o usuário existir, obtenha seus detalhes como um array
        $eventOwnerArray = $eventOwner ? $eventOwner->toArray() : null;

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwnerArray, 'hasUserJoined' => $hasUserJoined]);
    }


    public function dashboard()
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            // Obtenha todos os eventos, não apenas os eventos do usuário logado
            $events = Events::all();
            return view('events.dashboard', [
                'events' => $events
            ]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function destroy($id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;
    
        if ($userRole == 1) {
            // Obtenha o evento
            $event = Events::findOrFail($id);
    
            // Salve o caminho da imagem antiga
            $oldImagePath = $event->image;
    
            // Exclua o evento
            $event->delete();
    
            // Construa o caminho completo para a imagem antiga
            $fullOldImagePath = public_path('img/events/' . $oldImagePath);
    
            // Remova a imagem antiga após excluir o evento
            if (isset($oldImagePath) && file_exists($fullOldImagePath)) {
                unlink($fullOldImagePath);
                return redirect('/events/create/dashboard')->with('msg', 'Evento excluído com sucesso!');
            } else {
                return redirect('/events/create/dashboard')->with('msg', 'Evento excluído com sucesso! (Imagem antiga não encontrada)');
            }
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();
    
            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }
    

    public function edit($id)
    {
        $user = Auth::user() ?? null;
        $userRole = $user ? $user->role : null;

        if ($userRole == 1) {
            $event = Events::findOrFail($id);
            return view('events.edit', ['event' => $event]);
        } else {
            $quantidadeAnimaisCadastrados = Animal::count();

            return view('dashboard')->with('quantidadeAnimaisCadastrados', $quantidadeAnimaisCadastrados);
        }
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $userRole = $user ? $user->role : null;
    
        if ($userRole == 1) {
            $event = Events::findOrFail($id);
    
            // Salve o caminho da imagem atual em uma variável
            $oldImagePath = $event->image;
    
            $data = $request->except(['_token', '_method']);
    
            // Converta a data para o formato aceito pelo MySQL (Y-m-d)
            $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
    
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;
    
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
                $requestImage->move(public_path('img/events'), $imageName);
                $data['image'] = $imageName;
    
                // Construa o caminho completo para a imagem antiga
                $fullOldImagePath = public_path('img/events/' . $oldImagePath);
    
                // Remova a imagem antiga após a atualização
                if (isset($oldImagePath) && file_exists($fullOldImagePath)) {
                    unlink($fullOldImagePath);
                }
            }
    
            $event->update($data);
    
            return redirect('/events')->with('msg', 'Evento editado com sucesso!');
        } else {
            return view('dashboard');
        }
    }
    
}
