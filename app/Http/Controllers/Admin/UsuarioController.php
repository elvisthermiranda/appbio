<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver.usuarios')->only(['index', 'show']);
        $this->middleware('permission:editar.usuarios')->only(['edit', 'update']);
        $this->middleware('permission:criar.usuarios')->only(['create', 'store']);
        $this->middleware('permission:excluir.usuarios')->only('destroy');
        $this->middleware('permission:atualizar.senha.usuario')->only('updatePassword');
    }

    public function index(Request $request)
    {
        $usuarios = User::when($request->has('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('cpf', 'like', '%'.str_replace(['.','-'], '', $request->search).'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%');
            })
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.usuario.index', [
            'usuarios' => $usuarios,
        ]);
    }

    public function create()
    {
        return view('admin.usuario.create');
    }

    public function edit(User $user)
    {
        return view('admin.usuario.edit', [
            'usuario' => $user,
        ]);
    }

    public function show(User $user)
    {
        return view('admin.usuario.show', [
            'usuario' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'role' => 'required',
            'data_nascimento' => 'required',
            'altura' => 'required',
            'sexo' => 'required',
        ]);
        $date = implode('-', array_reverse(explode('/', $validated['data_nascimento'])));
        $validated['data_nascimento'] = Carbon::parse($date)->format('Y-m-d');
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'data_nascimento' => $validated['data_nascimento'],
            'altura' => $request->altura,
            'sexo' => $request->sexo,
        ]);
        $role = Role::findById($request->role);
        if ($role) {
            $user->syncRoles($role);
        } 
        return redirect()->back()->with('success', 'Informações de perfil do usuário editado com sucesso.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')],
            'role' => 'required',
            'password' => 'required|confirmed',
            'data_nascimento' => 'required',
            'altura' => 'required',
            'cpf' => ['required', Rule::unique('users')],
            'sexo' => 'required',
        ]);

        $data = implode('-', array_reverse(explode('/', $request->data_nascimento)));
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'altura' => $request->altura,
            'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
            'data_nascimento' => Carbon::parse($data)->format('Y-m-d'),
            'sexo' => $request->sexo,
        ]);

        $role = Role::findById($request->role);
        if ($role) {
            $user->syncRoles($role);
        }
        
        return redirect()->route('admin.users.show', ['user' => $user->id])->with('success', 'Usuário criado com sucesso.');
    }

    public function destroy(User $user)
    {
        if (Hash::check(request()->password, auth()->user()->password)) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Usuário deletado com sucesso.');
        }
        return redirect()->back()->withErrors(['password' => 'Senha incorreta']);
    }

    public function updatePassword(Request $request, User $user)
    {
        $validated = $request->validate([
            'password' => 'required|confirmed'
        ]);
        $user->password = Hash::make($validated['password'], ['rounds' => 12]);
        $user->save();
        return redirect()->route('admin.users.show', ['user' => $user->id])->with('success', 'Senha do usuário alterada com sucesso.');
    }
}
