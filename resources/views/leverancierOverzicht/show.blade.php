<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Tabel -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Naam Leverancier
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Contactpersoon
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Mobiel
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Stad
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Straat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Huisnummer
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse ($leverancier as $item)

                                @if (is_null($item->Stad) && is_null($item->Straat) && is_null($item->Huisnummer))
                                    <tr>
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $item->LeverancierNaam }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $item->ContactPersoon }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $item->Mobiel }}
                                        </td>

                                        <!-- Samengevoegde kolommen -->
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-400 dark:text-gray-300 italic">
                                            Er zijn geen adresgegevens bekend
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $item->LeverancierNaam }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $item->ContactPersoon }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $item->Mobiel }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $item->Stad }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $item->Straat }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                            {{ $item->Huisnummer }}
                                        </td>
                                    </tr>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-400 dark:text-gray-300">
                                        <i class="bi bi-inbox text-4xl mb-3 block"></i>
                                        Geen leveranciers gevonden
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
