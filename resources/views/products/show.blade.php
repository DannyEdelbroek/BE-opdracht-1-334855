<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Specificatie geleverde producten
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <!-- Product informatie -->
                @if(count($products) > 0)
                    <div class="mb-6 space-y-2">
                        <p class="text-gray-900 dark:text-gray-100">
                            <strong>Productnaam:</strong> {{ $products[0]->ProductNaam }}
                        </p>

                        <p class="text-gray-900 dark:text-gray-100">
                            <strong>Allergenen:</strong> {{ $products[0]->Allergenen ?? 'Geen allergenen bekend' }}
                        </p>
                    </div>
                @endif

                <!-- Tabel leveringen -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Datum levering
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Aantal
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">

                            @forelse ($products as $item)
                                <tr>
                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                        {{ \Carbon\Carbon::parse($item->DatumLevering)->format('d-m-Y') }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                        {{ $item->Aantal }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-10 text-center text-gray-400 dark:text-gray-300">
                                        Geen leveringen gevonden
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