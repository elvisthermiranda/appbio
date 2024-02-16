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
                <div class="max-w-xl">
                    @if ($errors->any())
                        @foreach ($errors->all() as $item)
                            {{ $item }}
                        @endforeach
                    @endif
                    <form action="{{ route('admin.roles.store') }}" method="post" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" :value="__('Nome do cargo')" />
                            <x-text-input id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        @can('criar.cargos')
                            <x-primary-button type="submit" class="dark:bg-gray-700 dark:hover:bg-gray-600">Salvar</x-primary-button>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>