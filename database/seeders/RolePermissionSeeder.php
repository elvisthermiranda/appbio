<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'ver.usuarios']);
        Permission::create(['name' => 'editar.usuarios']);
        Permission::create(['name' => 'criar.usuarios']);
        Permission::create(['name' => 'excluir.usuarios']);

        Permission::create(['name' => 'ver.orgaos']);
        Permission::create(['name' => 'editar.orgaos']);
        Permission::create(['name' => 'criar.orgaos']);
        Permission::create(['name' => 'excluir.orgaos']);


        Permission::create(['name' => 'ver.afericoes']);
        Permission::create(['name' => 'editar.afericoes']);
        Permission::create(['name' => 'criar.afericoes']);
        Permission::create(['name' => 'excluir.afericoes']);

        Permission::create(['name' => 'ver.cargos']);
        Permission::create(['name' => 'editar.cargos']);
        Permission::create(['name' => 'criar.cargos']);
        Permission::create(['name' => 'excluir.cargos']);

        Permission::create(['name' => 'ver.permissoes']);
        Permission::create(['name' => 'editar.permissoes']);
        Permission::create(['name' => 'criar.permissoes']);
        Permission::create(['name' => 'excluir.permissoes']);

        Permission::create(['name' => 'atualizar.senha.usuario']);
        Permission::create(['name' => 'adicionar.permissao.cargo']);
        Permission::create(['name' => 'revogar.permissao.cargo']);

        Role::create(['name' => 'Super-Admin']);

        $tecnico = Role::create(['name' => 'Tecnico']);
        $tecnico->givePermissionTo('ver.usuarios');
        $tecnico->givePermissionTo('editar.usuarios');
        $tecnico->givePermissionTo('criar.usuarios');
        $tecnico->givePermissionTo('excluir.usuarios');
        $tecnico->givePermissionTo('ver.orgaos');
        $tecnico->givePermissionTo('editar.orgaos');
        $tecnico->givePermissionTo('criar.orgaos');
        $tecnico->givePermissionTo('excluir.orgaos');
        $tecnico->givePermissionTo('ver.afericoes');
        $tecnico->givePermissionTo('editar.afericoes');
        $tecnico->givePermissionTo('criar.afericoes');
        $tecnico->givePermissionTo('excluir.afericoes');
        $tecnico->givePermissionTo('atualizar.senha.usuario');

        $paciente = Role::create(['name' => 'Paciente']);
        $paciente->givePermissionTo('ver.afericoes');
    }
}
