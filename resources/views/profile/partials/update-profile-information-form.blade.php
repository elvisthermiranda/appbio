<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Celular -->
        <div>
            <x-input-label for="celular" :value="__('Celular')" />
            <x-text-input id="celular" class="block mt-1 w-full" type="text" name="celular" :value="old('celular', $user->celular)" autofocus autocomplete="celular" />
            <x-input-error :messages="$errors->get('celular')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div>
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf', $user->cpf)" required autofocus autocomplete="cpf" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Nascimento -->
        <div class="mt-4">
            <x-input-label for="data_nascimento" :value="__('Data de nascimento')" />
            <x-text-input id="data_nascimento" class="block mt-1 w-full" type="text" name="data_nascimento" :value="old('data_nascimento', date('d/m/Y', strtotime($user->data_nascimento)))" required autofocus autocomplete="data_nascimento" />
            <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
        </div>

        <!-- Altura -->
        <div class="mt-4">
            <x-input-label for="altura" :value="__('Altura')" />
            <x-text-input id="altura" class="block mt-1 w-full" type="text" name="altura" :value="old('altura', $user->altura)" required autofocus autocomplete="altura" />
            <x-input-error :messages="$errors->get('altura')" class="mt-2" />
        </div>

        <!-- Sexo -->
        <div class="mt-4">
            <x-input-label for="sexo" :value="__('Sexo')" />
            <x-select-input id="sexo" name="sexo" class="mt-1 block w-full">
                <option value="F" @selected(old('sexo', $user->sexo) == 'F')>Feminino</option>
                <option value="M" @selected(old('sexo', $user->sexo) == 'M')>Masculino</option>
            </x-select-input>
            <x-input-error class="mt-2" :messages="$errors->get('sexo')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="dark:bg-gray-700 dark:hover:bg-gray-600">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

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
</section>
