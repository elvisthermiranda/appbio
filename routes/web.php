<?php

use App\Http\Controllers\Admin\AfericaoController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return redirect()->route('afericoes.index');
        })->name('dashboard');
        Route::resource('afericoes', AfericaoController::class);
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::name('admin.')
            ->group(function () {
                Route::resources([
                    'users' => UsuarioController::class,
                    'roles' => RoleController::class,
                    'permissions' => PermissionController::class,
                ]);
                Route::post('/add-permission-role', [RoleController::class, 'addPermission'])
                    ->name('add.permission.role');
                Route::post('/revoke-permission-role', [RoleController::class, 'revokePermission'])
                    ->name('revoke.permission.role');
                Route::put('/user/{user}/password-update', [UsuarioController::class, 'updatePassword'])->name('users.password-update');
                Route::get('/bioimpedancia/{user}/registro', [AfericaoController::class, 'create'])->name('exames.create');
                Route::post('/bioimpedancia/salvar', [AfericaoController::class, 'store'])->name('exames.store');
            });

        Route::get('/afericao/{afericao}', [AfericaoController::class, 'show'])->name('afericao.show');
    });

require __DIR__.'/auth.php';
