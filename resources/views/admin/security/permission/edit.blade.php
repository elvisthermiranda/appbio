<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissão') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-secondary-button type="button" x-data="{route: '{{ route('admin.permissions.create') }}'}" x-on:click="window.location.href=route">
                <i class="fa-solid fa-circle-chevron-left"></i>&nbsp;Voltar
            </x-secondary-button>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <form action="{{ route('admin.permissions.update', ['permission' => $permission->id]) }}" method="POST" class="mt-6 space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="name" :value="__('Permissão')" />
                        <x-text-input id="name" name="name" value="{{ old('name', $permission->name) }}" class="mt-1 block w-full" />
                    </div>

                    @can('editar.permissoes')
                        <div class="flex items-center gap-4">
                            <x-primary-button type="submit" class="dark:bg-gray-700 dark:hover:bg-gray-600">
                                <i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar
                            </x-primary-button>
                        </div>
                    @endcan
                </form>
            </div>
        </div>
    </div>
</x-app-layout>