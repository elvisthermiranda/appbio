<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver.permissoes')->only(['index', 'show']);
        $this->middleware('permission:editar.permissoes')->only(['edit', 'update']);
        $this->middleware('permission:criar.permissoes')->only(['create', 'store']);
        $this->middleware('permission:excluir.permissoes')->only('destroy');
    }

    public function index()
    {
        return view('admin.security.permission.index', [
            'permissions' => Permission::paginate(10)->withQueryString(),
        ]);
    }

    public function create()
    {
        return view('admin.security.permission.create');
    }

    public function edit(Permission $permission)
    {
        return view('admin.security.permission.edit', [
            'permission' => $permission,
        ]);
    }

    public function show(Permission $permission)
    {
        return view('admin.security.permission.show', [
            'permission' => $permission,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', Rule::unique('permissions')],
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.permissions.show', ['permission' => $permission->id])->with('success', 'Permissão criada com sucesso.');
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', Rule::unique('permissions')->ignore($permission->id)],
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('admin.permissions.show', ['permission' => $permission->id])->with('success', 'Permissão editada com sucesso.');
    }

    public function destroy(Permission $permission)
    {
        if (Hash::check(request()->password, auth()->user()->password)) {
            $permission->delete();
            return redirect()->route('admin.permissions.index')->with('success', 'Permissão deletada com sucesso.');
        }
        return redirect()->back()->withErrors(['password' => 'Senha incorreta']);
    }
}
