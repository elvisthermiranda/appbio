<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aferições') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('error'))
                <x-alert type="danger" bordered="true" header="Ops!">
                    {{ session('error') }}
                </x-alert>
            @endif
            @if (session('success'))
                <x-alert type="success" bordered="true" header="Pronto!">
                    {{ session('success') }}
                </x-alert>
            @endif
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-600 shadow sm:rounded-lg">
                <form class="mb-4 grid grid-cols-12 gap-1" method="get">
                    <div class="col-span-12 inline-flex">
                        <x-text-input id="search" name="search" class="w-full rounded-r-none" placeholder="Pesquise por nome do responsável ou paciente e cpf." />
                        <x-secondary-button type="submit" class="rounded-l-none">Buscar</x-secondary-button>
                    </div>
                </form>

                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Responsável</th>
                                <th scope="col" class="px-6 py-3">Paciente</th>
                                <th scope="col" class="px-6 py-3">Data</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($registros as $registro)
                                <tr
                                    @class([
                                        'bg-white',
                                        'dark:bg-gray-800',
                                        'dark:border-gray-700',
                                        'border-b' => $registros->last() != $registro,
                                    ])
                                >
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $registro->responsavel->name }}</td>
                                    <td class="px-6 py-4">{{ $registro->usuario->name }}</td>
                                    <td class="px-6 py-4">{{ date('d/m/Y', strtotime($registro->created_at)) }}</td>
                                    <td class="px-6 py-4">
                                        @can('ver.afericoes')
                                            <x-secondary-button
                                                type="button"
                                                aria-label="Botão para visualizar sua bioimpedância."
                                                title="Clique aqui para visualizar sua bioimpedância."
                                                x-data="{route: '{{ route('afericao.show', ['afericao' => $registro->id]) }}'}"
                                                x-on:click="window.location.href=route"
                                            >
                                                <i class="fa-solid fa-eye"></i>
                                            </x-secondary-button>
                                        @endcan

                                        @can('editar.afericoes')
                                            <x-secondary-button
                                                type="button"
                                                aria-label="Botão de edição da bioimpedância de {{ $registro->usuario->name }}."
                                                title="Clique aqui para editar a bioimpedância de {{ $registro->usuario->name }}."
                                                x-data="{route: '{{ route('afericoes.edit', ['aferico' => $registro->id]) }}'}"
                                                x-on:click="window.location.href=route"
                                            >
                                                <i class="fa-solid fa-pencil"></i>
                                            </x-secondary-button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Nenhum registro encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
