<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Log in') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('Register') }}</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <img src="{{ asset('icone-sante-rouge.png') }}" class="w-32" />
                </div>

                <div class="mt-16">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <img src="{{ asset('images/data_analysis_icon_131031.png') }}" alt="Avaliação da Composição Corporal" class="w-10 h-10 stroke-red-500">
                                </div>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Avaliação da Composição Corporal</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    A bioimpedância oferece uma avaliação mais detalhada da composição corporal do que simplesmente medir o peso ou o IMC (índice de massa corporal). Ela diferencia entre a massa gorda e a massa magra, permitindo que você compreenda melhor a proporção de músculos e gordura em seu corpo.
                                </p>
                            </div>
                        </div>

                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <img src="{{ asset('images/analysis_icon-icons.com_66851.png') }}" alt="Avaliação da Composição Corporal" class="w-10 h-10 stroke-red-500">
                                </div>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Monitoramento do Progresso Fitness</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Para pessoas que estão buscando perder peso, ganhar massa muscular ou atingir outros objetivos de saúde e fitness, a bioimpedância pode ser uma ferramenta útil para monitorar o progresso ao longo do tempo. Ela ajuda a identificar se as mudanças na composição corporal estão ocorrendo de maneira saudável e eficaz.
                                </p>
                            </div>
                        </div>

                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <img src="{{ asset('images/examination_physical_statistic_fitness_diet_icon_149050.png') }}" alt="Avaliação da Composição Corporal" class="w-10 h-10 stroke-red-500">
                                </div>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Personalização de Planos Nutricionais e de Exercícios</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Com base nos dados da análise de bioimpedância, profissionais de saúde e treinadores podem personalizar planos nutricionais e de exercícios para atender às necessidades individuais. Isso é especialmente relevante porque diferentes tipos de corpo podem responder de maneira diferente a diferentes abordagens.
                                </p>
                            </div>
                        </div>

                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                                    <img src="{{ asset('images/hydration_drink_reusable_flask_water_bottle_icon_260935.png') }}" alt="Avaliação da Composição Corporal" class="w-10 h-10 stroke-red-500">
                                </div>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Acompanhamento da Hidratação</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    A bioimpedância também pode fornecer informações sobre os níveis de hidratação do corpo. A quantidade adequada de água no organismo é crucial para diversas funções fisiológicas, e o acompanhamento dos níveis de hidratação pode ajudar a manter a saúde geral.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                        <div class="flex items-center gap-4">
                            Desenvolvido por Elvisther C. Miranda
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        AppBIO v1.0.0
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
