<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Registro
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-secondary-button x-data="{route: '{{ url()->previous() }}'}" x-on:click="window.location.href=route">
                <i class="fa-solid fa-circle-chevron-left"></i>&nbsp;Voltar
            </x-secondary-button>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('afericoes.update', ['aferico' => $afericao->id]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $afericao->usuario->id }}">
                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" name="name" value="{{ $afericao->usuario->name }}" class="mt-1 block w-full" disabled />
                        </div>
                        <div>
                            <x-input-label for="peso" :value="__('Peso')" />
                            <x-text-input name="peso" id="peso" value="{{ old('peso', $afericao->peso) }}" class="mt-1 block w-full decimal" required />
                        </div>
                        <div>
                            <x-input-label for="circunferencia_abdominal" :value="__('Circunferência abdominal')" />
                            <x-text-input id="circunferencia_abdominal" value="{{ old('peso', $afericao->circunferencia_abdominal) }}" name="circunferencia_abdominal" class="mt-1 block w-full decimal" min="0" required />
                        </div>
                        <div>
                            <x-input-label for="percentual_massa_muscular" :value="__('Percentual de massa muscular')" />
                            <x-text-input id="percentual_massa_muscular" value="{{ old('peso', $afericao->percentual_massa_muscular) }}" name="percentual_massa_muscular" class="mt-1 block w-full decimal" min="0" required />
                        </div>
                        <div>
                            <x-input-label for="gordura_visceral" :value="__('Gordura visceral')" />
                            <x-text-input id="gordura_visceral" value="{{ old('peso', $afericao->gordura_visceral) }}" name="gordura_visceral" class="mt-1 block w-full decimal" min="0" required />
                        </div>
                        <div>
                            <x-input-label for="percentual_gordura" :value="__('Percentual de gordura')" />
                            <x-text-input id="percentual_gordura" value="{{ old('peso', $afericao->percentual_gordura) }}" name="percentual_gordura" class="mt-1 block w-full decimal" min="0" required />
                        </div>
                        <div>
                            <x-input-label for="metabolismo" :value="__('Metabolismo')" />
                            <x-text-input type="number" id="metabolismo" value="{{ old('peso', $afericao->metabolismo) }}" name="metabolismo" class="mt-1 block w-full" min="0" required />
                        </div>
                        <div>
                            <x-input-label for="idade_metabolica" :value="__('Idade metabólica')" />
                            <x-text-input type="number" id="idade_metabolica" value="{{ old('peso', $afericao->idade_metabolica) }}" name="idade_metabolica" class="mt-1 block w-full" min="0" required />
                        </div>

                        @can('editar.afericoes')
                            <x-primary-button type="submit">Salvar</x-primary-button>
                        @endcan
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Inputmask({
                alias: 'decimal',
                radixPoint: '.',
                inputtype: "text",
                rightAlign: false
            }).mask(document.querySelectorAll('.decimal'))
        })
    </script>
</x-app-layout>
