<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Usuário
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <x-secondary-button x-data="{route: '{{ url()->previous() }}'}" x-on:click="window.location.href=route">
                <i class="fa-solid fa-circle-chevron-left"></i>&nbsp;Voltar
            </x-secondary-button>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <div class="max-w-xl">
                    <section>
                        <form method="post" action="{{ route('admin.users.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('POST')
                            <!-- CPF -->
                            <div>
                                <x-input-label for="cpf" :value="__('CPF')" />
                                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required autofocus autocomplete="cpf" />
                                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Nome completo')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="data_nascimento" :value="__('Data de nascimento')" />
                                <x-text-input type="date" id="data_nascimento" name="data_nascimento" type="text" class="mt-1 block w-full" :value="old('data_nascimento')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('data_nascimento')" />
                            </div>

                            <div>
                                <x-input-label for="altura" :value="__('Altura')" />
                                <x-text-input id="altura" name="altura" type="text" class="mt-1 block w-full" :value="old('altura')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('altura')" />
                            </div>

                            <div>
                                <x-input-label for="sexo" :value="__('Sexo')" />
                                <x-select-input id="sexo" name="sexo" class="mt-1 block w-full">
                                    <option value="F" @selected(old('sexo') == 'F')>Feminino</option>
                                    <option value="M" @selected(old('sexo') == 'M')>Masculino</option>
                                </x-select-input>
                                <x-input-error class="mt-2" :messages="$errors->get('sexo')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="role" :value="__('Tipo')" />
                                <x-select-input id="role" name="role" class="mt-1 block w-full">
                                    @foreach (\Spatie\Permission\Models\Role::where('name', '!=', 'Super-Admin')->get() as $role)
                                        <option value="{{ $role->id }}" @selected((old('role') == $role->id))>{{ $role->name }}</option>
                                    @endforeach
                                </x-select-input>
                            </div>

                            <div>
                                <x-input-label for="password" :value="__('Crie uma senha')" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                    
                            <div>
                                <x-input-label for="password_confirmation" :value="__('Confirme a senha')" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            
                            @can('criar.usuarios')
                                <x-primary-button type="submit" class="dark:bg-gray-700 dark:hover:bg-gray-600">Criar Usuário</x-primary-button>
                            @endcan
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const inputDataNascimento = document.querySelector('#data_nascimento')
                const inputAltura = document.querySelector('#altura')
                const inputCPF = document.querySelector('#cpf')

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

                Inputmask({
                    mask: '999.999.999-99',
                    rightAlign: false,
                }).mask(inputCPF)
            })
        </script>
    @endpush
</x-app-layout>