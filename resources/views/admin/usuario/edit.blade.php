<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Visualizar Usuário
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-secondary-button x-data="{route: '{{ url()->previous() }}'}" x-on:click="window.location.href=route">
                <i class="fa-solid fa-circle-chevron-left"></i>&nbsp;Voltar
            </x-secondary-button>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <div class="max-w-xl">
                    @if (session('success'))
                        <<x-alert type="success" bordered="true" header="Pronto!">
                            {{ session('success') }}
                        </x-alert>
                    @endif
                    
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Informação do Perfil') }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("Atualize as informações de perfil e o endereço de e-mail da conta.") }}
                        </p>
                    </header>
                    <form action="{{ route('admin.users.update', ['user' => $usuario->id]) }}" method="POST" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" name="name" value="{{ old('name', $usuario->name) }}" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="data_nascimento" :value="__('Data de nascimento')" />
                            <x-text-input type="date" id="data_nascimento" name="data_nascimento" type="text" class="mt-1 block w-full" :value="old('data_nascimento', date('d/m/Y', strtotime($usuario->data_nascimento)))" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('data_nascimento')" />
                        </div>

                        <div>
                            <x-input-label for="sexo" :value="__('Sexo')" />
                            <x-select-input id="sexo" name="sexo" class="mt-1 block w-full">
                                <option value="F" @selected(old('sexo', $usuario->sexo) == 'F')>Feminino</option>
                                <option value="M" @selected(old('sexo', $usuario->sexo) == 'M')>Masculino</option>
                            </x-select-input>
                            <x-input-error class="mt-2" :messages="$errors->get('sexo')" />
                        </div>

                        <div>
                            <x-input-label for="altura" :value="__('Altura')" />
                            <x-text-input id="altura" name="altura" type="text" class="mt-1 block w-full" :value="old('altura', $usuario->altura)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('altura')" />
                        </div>
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" value="{{ old('email', $usuario->email) }}" class="mt-1 block w-full" />
                        </div>
                        <div>
                            <x-input-label for="role" :value="__('Tipo')" />
                            <x-select-input id="role" name="role" class="mt-1 block w-full">
                                @foreach (\Spatie\Permission\Models\Role::where('name', '!=', 'Super-Admin')->get() as $role)
                                    <option value="{{ $role->id }}" @selected($usuario->hasRole($role->name))>{{ $role->name }}</option>
                                @endforeach
                            </x-select-input>
                        </div>

                        @can('editar.usuarios')
                            <div class="flex items-center gap-4">
                                <x-primary-button type="submit" class="dark:bg-gray-700 dark:hover:bg-gray-600">
                                    <i class="fa-solid fa-floppy-disk"></i>&nbsp;Salvar
                                </x-primary-button>
                            </div>
                        @endcan
                    </form>
                </div>
            </div>
            
            @can('atualizar.senha.usuario')
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                    <div class="max-w-xl">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Atualizar Senha') }}
                                </h2>
                        
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Certifique-se de atualizar para uma senha longa e aleatória para manter segura.') }}
                                </p>
                            </header>
                        
                            <form method="POST" action="{{ route('admin.users.password-update', ['user' => $usuario->id]) }}" class="mt-6 space-y-6">
                                @csrf
                                @method('put')
                        
                                <div>
                                    <x-input-label for="password" :value="__('Nova senha')" />
                                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                        
                                <div>
                                    <x-input-label for="password_confirmation" :value="__('Confirme a nova senha')" />
                                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                        
                                <div class="flex items-center gap-4">
                                    <x-primary-button class="dark:bg-gray-700 dark:hover:bg-gray-600">
                                        <i class="fa-solid fa-floppy-disk"></i>&nbsp;{{ __('Salvar') }}
                                    </x-primary-button>
                        
                                    @if (session('status') === 'password-updated')
                                        <p
                                            x-data="{ show: true }"
                                            x-show="show"
                                            x-transition
                                            x-init="setTimeout(() => show = false, 2000)"
                                            class="text-sm text-gray-600"
                                        >{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </section>                    
                    </div>
                </div>
            @endcan
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const inputDataNascimento = document.querySelector('#data_nascimento')
                const inputAltura = document.querySelector('#altura')

                Inputmask({
                    alias: 'decimal',
                    radixPoint: '.',
                    inputtype: 'text',
                    rightAlign: false,
                }).mask(inputAltura)

                Inputmask({
                    alias: 'datetime',
                    inputFormat: 'dd/mm/yyyy',
                    rightAlign: false,
                }).mask(inputDataNascimento)
            })
        </script>
    @endpush
</x-app-layout>