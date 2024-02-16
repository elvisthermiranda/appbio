<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- CPF -->
        <div>
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required autofocus autocomplete="cpf" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Nascimento -->
        <div class="mt-4">
            <x-input-label for="data_nascimento" :value="__('Data de nascimento')" />
            <x-text-input id="data_nascimento" class="block mt-1 w-full" type="text" name="data_nascimento" :value="old('data_nascimento')" required autofocus autocomplete="data_nascimento" />
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
        </div>

        <!-- Altura -->
        <div class="mt-4">
            <x-input-label for="altura" :value="__('Altura')" />
            <x-text-input id="altura" class="block mt-1 w-full" type="text" name="altura" :value="old('altura')" required autofocus autocomplete="altura" />
            <x-input-error :messages="$errors->get('altura')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="mt-4">
            <x-input-label for="sexo" :value="__('Sexo')" />
            <x-select-input id="sexo" name="sexo" class="mt-1 block w-full">
                <option value="F" @selected(old('sexo') == 'F')>Feminino</option>
                <option value="M" @selected(old('sexo') == 'M')>Masculino</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('sexo')" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="celular" :value="__('Celular')" />
            <x-text-input id="celular" class="block mt-1 w-full" type="text" name="celular" :value="old('celular')" autocomplete="celular" />
            <x-input-error :messages="$errors->get('celular')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

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
</x-guest-layout>
