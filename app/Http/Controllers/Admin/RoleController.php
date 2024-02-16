<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver.cargos')->only(['index', 'show']);
        $this->middleware('permission:editar.cargos')->only(['edit', 'update']);
        $this->middleware('permission:criar.cargos')->only(['create', 'store']);
        $this->middleware('permission:excluir.cargos')->only('destroy');
        $this->middleware('permission:adicionar.permissao.cargo')->only('addPermission');
        $this->middleware('permission:revogar.permissao.cargo')->only('revokePermission');
    }
    
    public function index()
    {
        $roles = Role::when(!Auth::user()->hasRole('Super-Admin'), function ($query) {
                $query->where('name', '!=', 'Super-Admin');
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.security.role.index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return view('admin.security.role.create');
    }

    public function edit(Role $role)
    {
        return view('admin.security.role.edit', [
            'role' => $role,
            'permissions' => Permission::whereNotIn('id', Arr::pluck($role->permissions, 'id'))->get(),
        ]);
    }

    public function show(Role $role)
    {
        return view('admin.security.role.show', [
            'role' => $role,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', Rule::unique('roles')],
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.roles.show', ['role' => $role->id])->with('success', 'Cargo criado com sucesso.');
    }

    public function update(Request $request, Role $role)
    {
        if (!Auth::user()->hasRole('Super-Admin') && $role->name == 'Super-Admin') {
            return redirect()->route('admin.roles.index')->with('error', 'Você não pode editar este cargo.');
        }

        $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($role->id)],
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('admin.roles.show', ['role' => $role->id])->with('success', 'Cargo editado com sucesso.');
    }

    public function destroy(Role $role)
    {
        if (!Auth::user()->hasRole('Super-Admin') && $role->name == 'Super-Admin') {
            return redirect()->route('admin.roles.index')->with('error', 'Você não pode deletar este cargo.');
        }

        if (Hash::check(request()->password, auth()->user()->password)) {
            $role->delete();
            return redirect()->route('admin.roles.index')->with('success', 'Cargo deletado com sucesso.');
        }
        return redirect()->back()->withErrors(['password' => 'Senha incorreta']);
    }

    public function addPermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        $role = Role::findById($request->role_id);
        $role->givePermissionTo(Permission::findById($request->permission_id));

        return redirect()->back()->with('success', 'Permissão atribuída com sucesso.');
    }

    public function revokePermission(Request $request)
    {
        $request->validate([
            'role_id' => 'required',
            'permission_id' => 'required',
        ]);

        $role = Role::findById($request->role_id);
        $role->revokePermissionTo(Permission::findById($request->permission_id));

        return redirect()->back()->with('success', 'Permissão revogada com sucesso.');
    }
}
