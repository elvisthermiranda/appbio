<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cargos') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @can('criar.cargos')
                <x-primary-button type="button" x-data="{route: '{{ route('admin.roles.create') }}'}" x-on:click="window.location.href=route">
                    <i class="fa-solid fa-plus"></i>&nbsp;Cadastrar
                </x-primary-button>
            @endcan
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 dark:border-gray-700 dark:border">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nome</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr
                                    @class([
                                        'bg-white',
                                        'dark:bg-gray-800',
                                        'dark:border-gray-700',
                                        'border-b' => $roles->last() != $role,
                                    ])
                                >
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $role->name }}</td>
                                    <td class="px-6 py-4">
                                        @can('ver.cargos')
                                            <x-secondary-button
                                                type="button"
                                                x-data="{route: '{{ route('admin.roles.show', ['role' => $role->id]) }}'}"
                                                x-on:click="window.location.href=route"
                                                aria-label="Botão para visualizar os dados deste órgão."
                                                title="Clique aqui para visualizar os dados deste órgão."
                                            >
                                                <i class="fa-solid fa-eye"></i>
                                            </x-secondary-button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Nenhum cargo cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $roles->links() }}
        </div>
    </div>
</x-app-layout>