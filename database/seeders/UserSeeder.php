<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\CryptoUser;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crear rol 'admin' solo si no existe
        $existingAdminRole = Role::where('name', 'admin')->first();
        if (!$existingAdminRole) {
            Role::create([
                'name' => 'admin',
            ]);
        }

        // Crear rol 'subscripto' solo si no existe
        $existingSubscriptoRole = Role::where('name', 'subscripto')->first();
        if (!$existingSubscriptoRole) {
            Role::create([
                'name' => 'subscripto',
            ]);
        }

        // Crear usuario 'juan' con el rol 'admin'
        $userJuan = CryptoUser::create([
            'name' => 'juan',
            'email' => 'juan@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Obtener el usuario recién creado
        $userJuan = CryptoUser::where('name', 'juan')->first();

        // Verificar si el usuario existe
        if ($userJuan) {
            // Obtener el rol 'admin'
            $adminRole = Role::where('name', 'admin')->first();

            // Verificar si el rol 'admin' existe
            if ($adminRole) {
                // Adjuntar el rol 'admin' al usuario
                $userJuan->roles()->attach($adminRole->id);
            } else {
                // Manejar el caso donde no se encuentra el rol 'admin'
                $this->command->error("Error: No se encontró el rol 'admin'.");
            }
        } else {
            // Manejar el caso donde no se encuentra el usuario 'juan'
            $this->command->error("Error: No se encontró el usuario 'juan'.");
        }

        // Crear usuario subscripto 'walter' con el rol 'subscripto'
        $userWalter = CryptoUser::create([
            'name' => 'walter',
            'email' => 'walter@gmail.com',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Obtener el usuario subscripto recién creado
        $userWalter = CryptoUser::where('name', 'walter')->first();

        // Verificar si el usuario subscripto 'walter' existe
        if ($userWalter) {
            // Asignar el rol 'subscripto' al usuario 'walter'
            $subscriptoRole = Role::where('name', 'subscripto')->first();
            $userWalter->roles()->attach($subscriptoRole->id);
        } else {
            // Manejar el caso donde no se encuentra el usuario 'walter'
            $this->command->error("Error: No se encontró el usuario 'walter'.");
        }

        // Crear dos usuarios ficticios más con el rol 'subscripto' y nombres reales
        $userReal1 = CryptoUser::create([
            'name' => 'miguel',
            'email' => 'miguel@mail.com',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userReal2 = CryptoUser::create([
            'name' => 'jesus',
            'email' => 'jesus@mail.com',
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Asignar el rol 'subscripto' a los nuevos usuarios ficticios
        $subscriptoRole = Role::where('name', 'subscripto')->first();
        $userReal1->roles()->attach($subscriptoRole->id);
        $userReal2->roles()->attach($subscriptoRole->id);
    }
}
