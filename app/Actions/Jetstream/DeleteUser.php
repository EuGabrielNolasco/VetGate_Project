<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use App\Models\Animal;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        // Obter todos os animais do usuário
        $animals = Animal::where('user_id', $user->id)->get();
    
        // Verificar se há animais antes de continuar
        if ($animals->isNotEmpty()) {
            foreach ($animals as $animal) {
                // Excluir todas as vacinas associadas ao animal
                $animal->vaccinations()->delete();
            }
    
            // Excluir todos os animais do usuário
            Animal::where('user_id', $user->id)->delete();
        }
    
        // Excluir a foto do perfil
        $user->deleteProfilePhoto();
    
        // Revogar todos os tokens de acesso do usuário
        $user->tokens->each->delete();
    
        // Excluir o usuário
        $user->delete();
    }
    

}
