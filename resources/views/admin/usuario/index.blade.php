<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuários
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @can('criar.usuarios')
                <x-primary-button type="button" x-data="{route: '{{ route('admin.users.create') }}'}" x-on:click="window.location.href=route">
                    <i class="fa-solid fa-plus"></i>&nbsp;Criar usuário
                </x-primary-button>
            @endcan
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <form class="mb-4 grid grid-cols-12 gap-1" method="get">
                    <div class="col-span-12 inline-flex">
                        <x-text-input id="search" name="search" class="w-full rounded-r-none" placeholder="Pesquise por nome, cpf e email." />
                        <x-secondary-button type="submit" class="rounded-l-none">Buscar</x-secondary-button>
                    </div>
                </form>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 dark:border dark:border-gray-700">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nome</th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Criado em</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($usuarios as $usuario)
                                <tr 
                                    @class([
                                        'bg-white',
                                        'dark:bg-gray-800',
                                        'dark:border-gray-700',
                                        'border-b' => $usuarios->last() != $usuario,
                                    ])
                                >
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $usuario->name }}</th>
                                    <td class="px-6 py-4">{{ $usuario->email }}</td>
                                    <td class="px-6 py-4">{{ date('d/m/Y', strtotime($usuario->created_at)) }}</td>
                                    <td class="px-6 py-4">
                                        @can('ver.usuarios')
                                            <x-secondary-button
                                                type="button"
                                                x-data="{route: '{{ route('admin.users.show', ['user' => $usuario->id]) }}'}"
                                                x-on:click="window.location.href=route"
                                                aria-label="Botão para visualizar os dados do usuário {{ $usuario->name }}."
                                                title="Clique aqui para visualizar os dados do usuário {{ $usuario->name }}."
                                            >
                                                <i class="fa-solid fa-eye"></i>
                                            </x-secondary-button>
                                        @endcan

                                        @can('criar.afericoes')
                                            <x-secondary-button
                                                type="button"
                                                aria-label="Botão de registro da bioimpedância de {{ $usuario->name }}."
                                                title="Clique aqui para registrar a bioimpedância de {{ $usuario->name }}."
                                                x-data="{route: '{{ route('admin.exames.create', ['user' => $usuario->id]) }}'}"
                                                x-on:click="window.location.href=route"
                                            >
                                                <i class="fa-solid fa-heart-circle-plus"></i>
                                            </x-secondary-button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum usuário cadastrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $usuarios->links() }}
        </div>
    </div>
</x-app-layout>