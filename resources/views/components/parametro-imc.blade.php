<div class="relative overflow-x-auto border sm:rounded-lg dark:border-gray-700">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 sm:rounded-lg">
        <thead class="text-xs bg-gray-50 text-gray-700 uppercase dark:text-gray-400 dark:bg-gray-700">
            <tr>
                <th scope="col" class="px-6 py-2 bg-gray-50 dark:bg-gray-800">
                    Parâmetros IMC
                </th>
                <th scope="col" class="px-6 py-2 bg-gray-50 dark:bg-gray-800">
                    IMC
                </th>
            </tr>
        </thead>
        <tbody class="text-black">
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Menos de 18,5
                </td>
                <td scope="row" class="px-6 py-2 bg-gray-50 dark:bg-gray-800">
                    <x-badge color="yellow" class="bg-yellow-300 text-black">Baixo peso</x-badge>
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    18,5 a 24,9
                </td>
                <td scope="row" class="px-6 py-2 bg-gray-50 dark:bg-gray-800">
                    <x-badge color="green" class="bg-green-300 text-black">Saudável</x-badge>
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    25 a 29,9
                </td>
                <td scope="row" class="px-6 py-2 bg-gray-50 dark:bg-gray-800">
                    <x-badge color="yellow" class="text-black">Sobrepeso</x-badge>
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    30 a 34,9
                </td>
                <td scope="row" class="px-6 py-2 bg-gray-50 dark:bg-gray-800">
                    <x-badge color="red" class="bg-red-300 text-black">Obesidade 1</x-badge>
                </td>
            </tr>
            <tr class="border-b border-gray-200 dark:border-gray-700">
                <td scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    35 a 39,9
                </td>
                <td scope="row" class="px-6 py-2 bg-gray-50 dark:bg-gray-800">
                    <x-badge color="red" class="bg-red-400 text-black">Obesidade 2</x-badge>
                </td>
            </tr>
            <tr>
                <td scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                    Acima de 40
                </td>
                <td scope="row" class="px-6 py-2 bg-gray-50 dark:bg-gray-800">
                    <x-badge color="red" class="bg-red-500 text-black">Obesidade 3</x-badge>
                </td>
            </tr>
        </tbody>
    </table>
</div>