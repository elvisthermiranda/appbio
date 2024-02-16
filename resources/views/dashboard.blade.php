<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Responsável</th>
                                <th scope="col" class="px-6 py-3">Data</th>
                                <th scope="col" class="px-6 py-3"></th>
                                <th></th>
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
                                    <td class="px-6 py-4">{{ date('d/m/Y', strtotime($registro->created_at)) }}</td>
                                    <td class="px-6 py-4">
                                        <x-secondary-button
                                            type="button"
                                            aria-label="Botão para visualizar sua bioimpedância."
                                            title="Clique aqui para visualizar sua bioimpedância."
                                            x-data="{route: '{{ route('afericao.show', ['exame' => $registro->id]) }}'}"
                                            x-on:click="window.location.href=route"
                                        >
                                            <i class="fa-solid fa-eye"></i>
                                        </x-secondary-button>
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
