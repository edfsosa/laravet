<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Limpiar cache de permisos ---
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- Definir permisos básicos ---
        $permissions = [
            // Mascotas
            'view pets',
            'create pets',
            'edit pets',
            'delete pets',

            // Usuarios / clientes
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $this->command->info('Permissions seeded successfully.');

        // --- Crear roles y asignar permisos ---
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $vet = Role::firstOrCreate(['name' => 'Veterinarian']);
        $client = Role::firstOrCreate(['name' => 'Client']);

        $admin->givePermissionTo(Permission::all());

        $vet->givePermissionTo([
            'view pets',
            'create pets',
            'edit pets',
        ]);

        $client->givePermissionTo([
            'view pets',
        ]);

        // --- Asignar roles de ejemplo a usuarios ---
        if (User::count() === 0) {
            User::factory()->count(10)->create();
        }

        // Primer usuario como admin
        $firstUser = User::first();
        $firstUser->assignRole('Admin');

        // Otros usuarios aleatorios
        User::where('id', '!=', $firstUser->id)
            ->each(function ($user) use ($vet, $client) {
                $role = collect(['Veterinarian', 'Client'])->random();
                $user->assignRole($role);
            });

        $this->command->info('Roles assigned to users successfully.');
    }
}
