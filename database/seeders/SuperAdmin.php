<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class SuperAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'cpf' => '10000000000',
            'name' => 'Super Administrador',
            'email' => 'superadmin@email.com.br',
            'password' => Hash::make('password'),
            'data_nascimento' => Carbon::now(),
            'altura' => 1.70,
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $user->syncRoles(Role::findByName('Super-Admin'));
    }
}
