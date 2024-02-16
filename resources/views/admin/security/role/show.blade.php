<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cargo') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-secondary-button type="button" x-data="{route: '{{ route('admin.roles.index') }}'}" x-on:click="window.location.href=route">
                <i class="fa-solid fa-circle-chevron-left"></i>&nbsp;Voltar
            </x-secondary-button>
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <div class="max-w-xl">
                    @if (session('success'))
                        <x-alert type="success" header="Pronto!">{{ session('success') }}</x-alert-success>
                    @endif

                    <div class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input disabled id="name" name="name" value="{{ $role->name }}" class="mt-1 block w-full" />
                        </div>
                    </div>
                </div>
                
            </div>

            @can('editar.cargos')
                <x-primary-button
                    type="button"
                    x-data="{route: '{{ route('admin.roles.edit', ['role' => $role->id]) }}'}"
                    x-on:click="window.location.href=route"
                >
                    <i class="fa-solid fa-pen-to-square"></i>&nbsp;Editar
                </x-primary-button>
            @endcan

            @can('excluir.cargos')
                <x-danger-button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                    <i class="fa-solid fa-trash"></i>&nbsp;Excluir
                </x-primary-button>
            @endcan
        </div>
    </div>

    @can('excluir.cargos')
        <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
            <form action="{{ route('admin.roles.destroy', ['role' => $role->id]) }}" method="post" class="p-6">
                @csrf
                @method('DELETE')
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Você tem certeza de que deseja excluir?') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Uma vez que for excluída, todos os seus recursos e dados serão apagados permanentemente. Por favor, digite sua senha para confirmar que deseja excluir permanentemente esta conta.') }}
                </p>
                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Senha') }}"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        <i class="fa-solid fa-xmark"></i>&nbsp;{{ __('Cancelar') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        <i class="fa-solid fa-trash"></i>&nbsp;{{ __('Sim, excluir este cargo.') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endcan
</x-app-layout>