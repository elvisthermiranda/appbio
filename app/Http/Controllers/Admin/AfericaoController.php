<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessarNovoExame;
use App\Models\Afericao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AfericaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver.afericoes')->only(['index', 'show']);
        $this->middleware('permission:editar.afericoes')->only(['edit', 'update']);
        $this->middleware('permission:criar.afericoes')->only(['create', 'store']);
        $this->middleware('permission:excluir.afericoes')->only('destroy');
    }

    public function index(Request $request)
    {
        $registros = Afericao::when(Auth::user()->hasRole('Paciente'), function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $query->whereHas('usuario', function ($usuarioQuery) use ($request) {
                    $cpf = str_replace(['.', '-'], '', $request->search);
                    $usuarioQuery->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('cpf', 'like', '%'.$cpf.'%');
                })
                ->orWhereHas('responsavel', function ($responsavelQuery) use ($request) {
                    $cpf = str_replace(['.', '-'], '', $request->search);
                    $responsavelQuery->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('cpf', 'like', '%'.$cpf.'%');
                })
                ->orWhereDate('created_at', implode('-', array_reverse(explode('/', $request->search))));
            })
            ->paginate(10);

        return view('admin.afericao.index', [
            'registros' => $registros,
        ]);
    }

    public function create(User $user)
    {
        return view('admin.afericao.create', [
            'usuario' => $user,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'peso' => 'required',
            'circunferencia_abdominal' => 'required',
            'percentual_massa_muscular' => 'required',
            'gordura_visceral' => 'required',
            'percentual_gordura' => 'required',
            'metabolismo' => 'nullable',
            'idade_metabolica' => 'nullable',
        ]);
        
        $user = User::find($request->user_id);

        $afericao = new Afericao;
        $afericao->peso = $request->peso;
        $afericao->circunferencia_abdominal = $request->circunferencia_abdominal;
        $afericao->percentual_massa_muscular = $request->percentual_massa_muscular;
        $afericao->gordura_visceral = $request->gordura_visceral;
        $afericao->percentual_gordura = $request->percentual_gordura;
        $afericao->responsavel_id = Auth::user()->id;
        $afericao->user_id = $user->id;
        $afericao->altura = $user->altura;
        $afericao->metabolismo = $request->metabolismo;
        $afericao->idade_metabolica = $request->idade_metabolica;
        $afericao->idade = Carbon::now()->diffInYears($user->data_nascimento);
        $afericao->save();

        ProcessarNovoExame::dispatch($afericao)->onQueue('default');
        
        return redirect()->route('afericao.show', ['afericao' => $afericao->id])->with('success', 'Aferição gravada com sucesso.');
    }

    public function edit(Afericao $aferico)
    {
        return view('admin.afericao.edit', [
            'afericao' => $aferico,
        ]);
    }

    public function update(Request $request, Afericao $aferico)
    {
        $validated = $request->validate([
            'peso' => 'required',
            'circunferencia_abdominal' => 'required',
            'percentual_massa_muscular' => 'required',
            'gordura_visceral' => 'required',
            'percentual_gordura' => 'required',
            'metabolismo' => 'nullable',
            'idade_metabolica' => 'nullable',
        ]);

        $aferico->update($validated);
        return redirect()->route('afericao.show', ['afericao' => $aferico->id])->with('success', 'Aferição editada com sucesso.');
    }

    public function destroy(Afericao $aferico)
    {
        if (Hash::check(request()->password, auth()->user()->password)) {
            $aferico->delete();
            return redirect()->route('afericoes.index')->with('success', 'Aferição deletada com sucesso.');
        }
        return redirect()->back()->withErrors(['password' => 'Senha incorreta']);
    }

    public function show(Afericao $afericao)
    {
        if (Auth::user()->hasRole('Paciente') && $afericao->user_id != Auth::user()->id) {
            return redirect()->route('afericoes.index')->with('error', 'Aferição não encontrada.');
        }
        return view('admin.afericao.show', [
            'afericao' => $afericao,
        ]);
    }
}
