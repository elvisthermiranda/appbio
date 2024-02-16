<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cargo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-secondary-button type="button" x-data="{route: '{{ route('admin.roles.create') }}'}" x-on:click="window.location.href=route">
                <i class="fa-solid fa-circle-chevron-left"></i>&nbsp;Voltar
            </x-secondary-button>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                @if (session('success'))
                    <x-alert type="success" header="Pronto!">{{ session('success') }}</x-alert-success>
                @endif

                <form action="{{ route('admin.roles.update', ['role' => $role->id]) }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Nome')" />
                        <x-text-input id="name" name="name" value="{{ old('name', $role->name) }}" class="mt-1 block w-full" />
                    </div>

                    @can('editar.cargos')
                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit" class="dark:bg-gray-700 dark:hover:bg-gray-600">
                                <i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar
                            </x-primary-button>
                        </div>
                    @endcan
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                @can('adicionar.permissao.cargo')
                    <x-primary-button
                        type="button"
                        class="dark:bg-gray-700 dark:hover:bg-gray-600"
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'add-permission-to-role')"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>&nbsp;Adicionar Permissão
                    </x-primary-button>
                @endcan
                <div class="relative overflow-x-auto mt-3">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 dark:border-gray-700 dark:border">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nome</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($role->permissions as $permission)
                                <tr
                                    @class([
                                        'bg-white',
                                        'dark:bg-gray-800',
                                        'dark:border-gray-700',
                                    ])
                                >
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $permission->name }}</td>
                                    <td class="px-6 py-4">
                                        @can('revogar.permissao.cargo')
                                            <x-danger-button
                                                type="button"
                                                class="dark:bg-gray-700 dark:hover:bg-gray-600"
                                                data-permission-id="{{ $permission->id }}"
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'revoke-permission-to-role_{{ $permission->id }}')"
                                            >
                                                <i class="fa-solid fa-trash"></i>&nbsp;Revogar Permissão
                                            </x-danger-button>
                                            <x-modal name="revoke-permission-to-role_{{ $permission->id }}" :show="$errors->isNotEmpty()" focusable>
                                                <form action="{{ route('admin.revoke.permission.role') }}" method="post" class="p-6">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="role_id" value="{{ $role->id }}">
                                                    <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Você tem certeza de que deseja revogar?') }}
                                                    </h2>
                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ __('Uma vez que for revogada, todos os seus recursos e dados serão apagados permanentemente.') }}
                                                    </p>
                                                
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            <i class="fa-solid fa-xmark"></i>&nbsp;{{ __('Cancelar') }}
                                                        </x-secondary-button>
                                        
                                                        <x-danger-button class="ml-3">
                                                            <i class="fa-solid fa-trash"></i>&nbsp;{{ __('Sim, revogar permissão.') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr
                                    @class([
                                        'bg-white',
                                        'dark:bg-gray-800',
                                        'dark:border-gray-700',
                                    ])
                                >
                                    <td colspan="2" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Nenhuma permissão cadastrada para este cargo.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @can('adicionar.permissao.cargo')
        <x-modal name="add-permission-to-role" :show="$errors->isNotEmpty()" focusable>
            <form action="{{ route('admin.add.permission.role') }}" method="post" class="p-6">
                @csrf
                @method('POST')
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Adicionar permissão') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Selecione uma permissão para atribuir a este cargo.') }}
                </p>

                <input type="hidden" name="role_id" value="{{ $role->id }}">

                <div class="mt-6">
                    <x-input-label for="permission" :value="__('Permissão')" />
                    <x-select-input id="permission" name="permission_id" class="mt-1 block w-full">
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}" @selected(old('permission_id') == $permission->id)>{{ $permission->name }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('permission_id')" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        <i class="fa-solid fa-xmark"></i>&nbsp;{{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-primary-button class="ml-3">
                        <i class="fa-solid fa-floppy-disk"></i>&nbsp;{{ __('Salvar') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
    @endcan
</x-app-layout>