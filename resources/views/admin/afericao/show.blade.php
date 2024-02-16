<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <x-alert type="success" bordered="true" header="Pronto!">
                    {{ session('success') }}
                </x-alert>
            @endif
            <div class="flex items-center p-4 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Resultados de sua aferição realizada no dia {{ date('d/m/Y', strtotime($afericao->created_at)) }}.</span>
                </div>
                @can('excluir.afericoes')
                    <x-danger-button class="ml-auto" type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-afericao-deletion')">
                        <i class="fa-solid fa-trash"></i>&nbsp;Excluir Aferição
                    </x-primary-button>
                @endcan
            </div>
            
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">IDADE</th>
                                <th scope="col" class="px-6 py-3">ALTURA</th>
                                <th scope="col" class="px-6 py-3">PESO</th>
                                <th scope="col" class="px-6 py-3">METABOLISMO</th>
                                <th scope="col" class="px-6 py-3">IDADE METABÓLICA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white dark:bg-gray-900 dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $afericao->idade }}</td>
                                <td class="px-6 py-4">{{ $afericao->altura }}</td>
                                <td class="px-6 py-4">{{ $afericao->peso }}</td>
                                <td class="px-6 py-4">{{ $afericao->metabolismo }}</td>
                                <td class="px-6 py-4">{{ $afericao->idade_metabolica }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Índice de Massa Corporal - IMC</h5>
                    <div class="relative overflow-x-auto border shadow mb-2 dark:border-gray-700 sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th scope="col" class="px-6 py-3">IMC</th>
                                <th scope="col" class="px-6 py-3">CLASSIFICAÇÃO IMC</th>
                            </thead>
                            <tbody>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    @php
                                        $imc = round($afericao->peso / pow($afericao->altura, 2), 2);
                                    @endphp
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $imc }}</td>
                                    <td class="px-6 py-4">
                                        @if ($imc < 18.5)
                                            <x-badge color="yellow" class="bg-yellow-300 text-black">Baixo peso</x-badge>
                                        @endif
                                        @if ($imc >= 18.5 && $imc <= 24.9)
                                            <x-badge color="green" class="text-black">Saudável <i class="fa-regular fa-circle-check"></i></x-badge>
                                        @endif
                                        @if ($imc >= 25 && $imc <= 29.9)
                                            <x-badge color="yellow" class="text-black">Sobrepeso</x-badge>
                                        @endif
                                        @if ($imc >= 30 && $imc <= 34.9)
                                            <x-badge color="red" class="bg-red-300 text-black">Obesidade 1</x-badge>
                                        @endif
                                        @if ($imc >= 35 && $imc <= 39.9)
                                            <x-badge color="red" class="bg-red-400 text-black">Obesidade 2</x-badge>
                                        @endif
                                        @if ($imc >= 40)
                                            <x-badge color="red" class="bg-red-500 text-black">Obesidade 3</x-badge>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="border bg-white shadow dark:border-gray-700 dark:shadow-transparent sm:rounded-lg">
                        <x-parametro-imc />
                    </div>
                </div>
                
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg ">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Circunferência Abdominal</h5>
                    <div class="relative overflow-x-auto border shadow sm:rounded-lg mb-2 dark:border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">CIRCUNFERÊNCIA ABDOMINAL</th>
                                    <th scope="col" class="px-6 py-3">CLASSIFICAÇÃO DA CIRCUNFERÊNCIA ABDOMINAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $afericao->circunferencia_abdominal }}</td>
                                    <td class="px-6 py-4">
                                        @if ($afericao->usuario->sexo == 'M')
                                            @if ($afericao->circunferencia_abdominal < 94)
                                                <x-badge color="green" class="bg-green-400 text-black">Faixar ideal <i class="fa-regular fa-circle-check"></i></x-badge>
                                            @endif
                                            @if ($afericao->circunferencia_abdominal >= 94 && $afericao->circunferencia_abdominal <= 101)
                                                <x-badge color="yellow" class="bg-yellow-300 text-black">Risco aumentado</x-badge>
                                            @endif
                                            @if ($afericao->circunferencia_abdominal >= 102)
                                                <x-badge color="red" class="bg-red-400 text-black">Risco muito aumentado</x-badge>
                                            @endif
                                        @else
                                            @if ($afericao->circunferencia_abdominal < 80)
                                                <x-badge color="green" class="bg-green-400 text-black">Faixar ideal <i class="fa-regular fa-circle-check"></i></x-badge>
                                            @endif
                                            @if ($afericao->circunferencia_abdominal >= 80 && $afericao->circunferencia_abdominal <= 87)
                                                <x-badge color="yellow" class="bg-yellow-300 text-black">Risco aumentado</x-badge>
                                            @endif
                                            @if ($afericao->circunferencia_abdominal >= 88)
                                                <x-badge color="red" class="bg-red-400 text-black">Risco muito aumentado</x-badge>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="border p-1 bg-white shadow sm:rounded-lg dark:bg-gray-700 dark:border-gray-700">
                        <x-parametro-circunferencia-abdominal />
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Percentual de Massa Muscular</h5>
                    <div class="relative overflow-x-auto border shadow mb-2 sm:rounded-lg dark:border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th scope="col" class="px-6 py-3">% DE MASSA MUSCULAR</th>
                                <th scope="col" class="px-6 py-3">CLASSIFICAÇÃO DO % DE MASSA MUSCULAR</th>
                            </thead>
                            <tbody>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $afericao->percentual_massa_muscular }}</td>
                                    <td class="px-6 py-4">
                                        @if ($afericao->usuario->sexo == 'M')
                                            @if ($afericao->idade >= 18 && $afericao->idade <= 39)
                                                @if ($afericao->percentual_massa_muscular < 33.3)
                                                    <x-badge color="yellow" class="bg-yellow-300 text-black">Baixo</x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 33.3 && $afericao->percentual_massa_muscular <= 39.3)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 39.4 && $afericao->percentual_massa_muscular <= 44)
                                                    <x-badge color="green" class="bg-green-300 text-black">Alto <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular > 44.1)
                                                    <x-badge color="green" class="bg-green-300 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif

                                            @if ($afericao->idade >= 40 && $afericao->idade <= 59)
                                                @if ($afericao->percentual_massa_muscular < 33.1)
                                                    <x-badge color="yellow" class="bg-yellow-300 text-black">Baixo</x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 33.1 && $afericao->percentual_massa_muscular <= 39.1)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 39.2 && $afericao->percentual_massa_muscular <= 43.8)
                                                    <x-badge color="green" class="bg-green-300 text-black">Alto <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 43.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif

                                            @if ($afericao->idade >= 60 && $afericao->idade <= 80)
                                                @if ($afericao->percentual_massa_muscular < 32.9)
                                                    <x-badge color="yellow" class="bg-yellow-300 text-black">Baixo</x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 32.9 && $afericao->percentual_massa_muscular <= 38.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 39 && $afericao->percentual_massa_muscular <= 43.6)
                                                    <x-badge color="green" class="bg-green-300 text-black">Alto <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 43.7)
                                                    <x-badge color="green" class="bg-green-300 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif
                                        @else
                                            @if ($afericao->idade >= 18 && $afericao->idade <= 39)
                                                @if ($afericao->percentual_massa_muscular < 24.3)
                                                    <x-badge color="yellow" class="bg-yellow-300 text-black">Baixo</x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 24.3 && $afericao->percentual_massa_muscular <= 30.3)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 30.4 && $afericao->percentual_massa_muscular <= 35.3)
                                                    <x-badge color="green" class="bg-green-300 text-black">Alto <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 35.4)
                                                    <x-badge color="green" class="bg-green-300 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif

                                            @if ($afericao->idade >= 40 && $afericao->idade <= 59)
                                                @if ($afericao->percentual_massa_muscular < 24.1)
                                                    <x-badge color="yellow" class="bg-yellow-300 text-black">Baixo</x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 24.1 && $afericao->percentual_massa_muscular <= 30.1)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 30.2 && $afericao->percentual_massa_muscular <= 35.1)
                                                    <x-badge color="green" class="bg-green-300 text-black">Alto <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 35.2)
                                                    <x-badge color="green" class="bg-green-300 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif

                                            @if ($afericao->idade >= 60 && $afericao->idade <= 80)
                                                @if ($afericao->percentual_massa_muscular < 23.9)
                                                    <x-badge color="yellow" class="bg-yellow-300 text-black">Baixo</x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 23.9 && $afericao->percentual_massa_muscular <= 29.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 30 && $afericao->percentual_massa_muscular <= 34.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Alto <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_massa_muscular >= 35)
                                                    <x-badge color="green" class="bg-green-300 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="border p-1 bg-white shadow sm:rounded-lg dark:border-gray-700 dark:bg-gray-700">
                        <x-parametro-percentual-massa-muscular />
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Gordura Visceral</h5>
                    <div class="relative overflow-x-auto border shadow mb-2 sm:rounded-lg dark:border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th scope="col" class="px-6 py-3">GORDURA VISCERAL</th>
                                <th scope="col" class="px-6 py-3">CLASSIFICAÇÃO DA GORDURA VISCERAL</th>
                            </thead>
                            <tbody>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $afericao->gordura_visceral }}</td>
                                    <td class="px-6 py-4">
                                        @if ($afericao->gordura_visceral <= 4)
                                            <x-badge color="green" class="bg-green-300 text-black">Ideal <i class="fa-regular fa-circle-check"></i></x-badge>
                                        @endif
                                        @if ($afericao->gordura_visceral >= 5 && $afericao->gordura_visceral <= 8)
                                            <x-badge color="green" class="bg-green-400 text-black">Saudável <i class="fa-regular fa-circle-check"></i></x-badge>
                                        @endif
                                        @if ($afericao->gordura_visceral >= 9 && $afericao->gordura_visceral <= 12)
                                            <x-badge color="red" class="bg-red-300 text-black">Ruim</x-badge>
                                        @endif
                                        @if ($afericao->gordura_visceral >= 13)
                                            <x-badge color="red" class="bg-red-400 text-black">Perigoso</x-badge>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="border bg-white shadow sm:rounded-lg dark:border-gray-700">
                        <x-parametro-gordura-visceral />
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Percentual de Gordura</h5>
                    <div class="relative overflow-x-auto border shadow mb-2 sm:rounded-lg dark:border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <th scope="col" class="px-6 py-3">% DE GORDURA</th>
                                <th scope="col" class="px-6 py-3">CLASSIFICAÇÃO % DE GORDURA</th>
                            </thead>
                            <tbody>
                                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $afericao->percentual_gordura }}</td>
                                    <td class="px-6 py-4">
                                        @if ($afericao->usuario->sexo == 'M')
                                            @if ($afericao->idade >= 20 && $afericao->idade <= 39)
                                                @if ($afericao->percentual_gordura < 8)
                                                    <x-badge color="green" class="bg-green-400 text-black">Baixo <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 8 && $afericao->percentual_gordura <= 19.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 22 && $afericao->percentual_gordura <= 24.9)
                                                    <x-badge color="red" class="bg-red-300 text-black">Alto</x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 25)
                                                    <x-badge color="red" class="bg-red-400 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif

                                            @if ($afericao->idade >= 40 && $afericao->idade <= 59)
                                                @if ($afericao->percentual_gordura < 11)
                                                    <x-badge color="green" class="bg-green-400 text-black">Baixo <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 11 && $afericao->percentual_gordura <= 21.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 22 && $afericao->percentual_gordura <= 27.9)
                                                    <x-badge color="red" class="bg-red-300 text-black">Alto</x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 28)
                                                    <x-badge color="red" class="bg-red-400 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif

                                            @if ($afericao->idade >= 60 && $afericao->idade <= 79)
                                                @if ($afericao->percentual_gordura < 13)
                                                    <x-badge color="green" class="bg-green-400 text-black">Baixo <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 13 && $afericao->percentual_gordura <= 24.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 25 && $afericao->percentual_gordura <= 29.9)
                                                    <x-badge color="red" class="bg-red-300 text-black">Alto</x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 30)
                                                    <x-badge color="red" class="bg-red-400 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif
                                        @else
                                            @if ($afericao->idade >= 20 && $afericao->idade <= 39)
                                                @if ($afericao->percentual_gordura < 21)
                                                    <x-badge color="green" class="bg-green-400 text-black">Baixo <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 21 && $afericao->percentual_gordura <= 32.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 33 && $afericao->percentual_gordura <= 38.9)
                                                    <x-badge color="red" class="bg-red-300 text-black">Alto</x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 39)
                                                    <x-badge color="red" class="bg-red-400 text-black">Muito alto</x-badge>
                                                @endif 
                                            @endif

                                            @if ($afericao->idade >= 40 && $afericao->idade <= 59)
                                                @if ($afericao->percentual_gordura < 23)
                                                    <x-badge color="green" class="bg-green-400 text-black">Baixo <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 23 && $afericao->percentual_gordura <= 33.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 34 && $afericao->percentual_gordura <= 39.9)
                                                    <x-badge color="red" class="bg-red-300 text-black">Alto</x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 40)
                                                    <x-badge color="red" class="bg-red-400 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif

                                            @if ($afericao->idade >= 60 && $afericao->idade <= 79)
                                                @if ($afericao->percentual_gordura < 24)
                                                    <x-badge color="green" class="bg-green-400 text-black">Baixo <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 24 && $afericao->percentual_gordura <= 35.9)
                                                    <x-badge color="green" class="bg-green-300 text-black">Normal <i class="fa-regular fa-circle-check"></i></x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 36 && $afericao->percentual_gordura <= 41.9)
                                                    <x-badge color="red" class="bg-red-300 text-black">Alto</x-badge>
                                                @endif
                                                @if ($afericao->percentual_gordura >= 42)
                                                    <x-badge color="red" class="bg-red-400 text-black">Muito alto</x-badge>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="border p-1 bg-white shadow sm:rounded-lg dark:border-gray-700 dark:bg-gray-700">
                        <x-parametro-percentual-gordura />
                    </div>
                </div>
            </div>

            {{-- <x-alert type="warning" bordered="true" header="Responsável pela aferição/para dúvidas e/ou orientações:">
                Valdecarlos José dos Santos (valdecarlossantos@seplag.mt.gov.br).
            </x-alert> --}}

            <x-alert type="info" bordered="true" header="Com alimentação saudável e atividade física você conseguirá. Mantenha o foco." />
        </div>
    </div>

    @can('excluir.afericoes')
        <x-modal name="confirm-afericao-deletion" :show="$errors->isNotEmpty()" focusable>
            <form action="{{ route('afericoes.destroy', ['aferico' => $afericao->id]) }}" method="POST" class="p-6">
                @csrf
                @method('DELETE')
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Você tem certeza de que deseja excluir?') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Uma vez que for excluída, todos os seus recursos e dados serão apagados permanentemente. Por favor, digite sua senha para confirmar que deseja excluir permanentemente este registro.') }}
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
                        <i class="fa-solid fa-trash"></i>&nbsp;{{ __('Sim, excluir este registro.') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endcan
</x-app-layout>