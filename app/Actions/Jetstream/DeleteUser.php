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
                // Remover o vínculo do animal com o usuário
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
            }
        }

        // Excluir a foto do perfil
        $user->deleteProfilePhoto();

        // Revogar todos os tokens de acesso do usuário
        $user->tokens->each->delete();

        // Excluir o usuário
        $user->delete();
    }
}
