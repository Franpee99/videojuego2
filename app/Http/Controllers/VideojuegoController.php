<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Models\Desarrolladora;
use App\Models\Distribuidora;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class VideojuegoController extends Controller implements HasMiddleware
{

    public static function middleware() // Para implementar que debe estar logeado
    {
        return [
            new Middleware('auth', only: ['create', 'store']), // Para que te rediriga a iniciar sesion
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = request()->user(); // Usuario autenticado

        $column = $request->query('sort', 'desarrolladoras.nombre');
        $direction = $request->query('direction', 'asc');

        if (!in_array($column, ['desarrolladoras.nombre', 'distribuidoras.nombre'])) {
            $column = 'desarrolladoras.nombre';
        }

        // Creamos la consulta base
        $query = Videojuego::with(['desarrolladora', 'desarrolladora.distribuidora'])
            ->join('desarrolladoras', 'videojuegos.desarrolladora_id', '=', 'desarrolladoras.id')
            ->leftJoin('distribuidoras', 'desarrolladoras.distribuidora_id', '=', 'distribuidoras.id')
            ->select('videojuegos.*', 'desarrolladoras.nombre as desarrolladora_nombre', 'distribuidoras.nombre as distribuidora_nombre');

        // Aplicamos filtro solo si el usuario NO es admin
        if ($user->name !== 'admin') {
            $query = $query->whereHas('posesiones', function ($subquery) use ($user) { //en caso de que el usuario posea el videojuego lo mostramos
                $subquery->where('user_id', $user->id);
            });
        }

        // Aplicamos ordenación y paginación
        $videojuegos = $query->orderBy($column, $direction)->paginate(10);

        return view('videojuegos.index', compact('videojuegos', 'column', 'direction'));
    }






    /**
     * Show the form for creating a new resource.
     */
    public function create(Videojuego $videojuego)
    {
        Gate::authorize('create', $videojuego);
        return view('videojuegos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideojuegoRequest $request)
    {

        //En vez de poner aqui la validacion, se pone en el StoreVideojuegoRequest

        $videojuego = new Videojuego($request->input());
        $videojuego->save();
        return redirect()->route('videojuegos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        Gate::authorize('update', $videojuego); //En el NoticiaPolicy ponemos quien quien puede editarlo (autorizacion)

        return view('videojuegos.edit', [
            'videojuego' => $videojuego,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideojuegoRequest $request, Videojuego $videojuego)
    {
        $videojuego->fill($request->input());
        $videojuego->save();
        return redirect()->route('videojuegos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        $videojuego->delete();
        return redirect()->route('videojuegos.index');
    }
}
