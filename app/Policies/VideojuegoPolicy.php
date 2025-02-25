<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Videojuego;
use Illuminate\Auth\Access\Response;

class VideojuegoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Videojuego $videojuego): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->name == 'admin'
            ? Response::allow()
            : Response::deny("No tienes permisos de administrador.");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Videojuego $videojuego): Response
    {
        return $user->name == 'admin' || $user->videojuegos()->where('videojuego_id', $videojuego->id)->exists()
            ? Response::allow()
            : Response::deny("No tienes permisos.");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Videojuego $videojuego): Response
    {
        return $user->name == 'admin'
            ? Response::allow()
            : Response::deny("El usuario no es el creador de la videojuego.");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Videojuego $videojuego): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Videojuego $videojuego): bool
    {
        return false;
    }
}
