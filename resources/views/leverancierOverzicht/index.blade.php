<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Filter dropdown -->
                <form method="GET" class="mb-6 flex gap-3">
                    <select name="allergeen"
                            class="rounded-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 px-4 py-2 focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            onchange="this.form.submit()">
                        <option value="">Alle allergenen</option>
                        @foreach ($AllergeenNamen as $item)
                            <option value="{{ $item->AllergeenNaam }}" 
                                {{ request('allergeen') == $item->AllergeenNaam ? 'selected' : '' }}>
                                {{ $item->AllergeenNaam }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <!-- Tabel -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">ProductNaam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">AllergeenNaam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">AantalAanwezig</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Omschrijving</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($Allergeens as $Allergeen)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $Allergeen->ProductNaam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $Allergeen->AllergeenNaam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $Allergeen->AantalAanwezig }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $Allergeen->Omschrijving }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('leverancier.showLeverancier', $Allergeen->LeverancierId) }}"
                                           class="inline-flex items-center px-3 py-1 border border-blue-500 text-blue-500 rounded-full text-sm font-medium hover:bg-blue-500 hover:text-white transition">
                                           <i class="bi bi-pencil mr-1"></i> Bewerk
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-400 dark:text-gray-300">
                                        <i class="bi bi-inbox text-4xl mb-3 block"></i>
                                        <strong>Geen informatie gevonden op dit moment</strong>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex space-x-2">
                    {{-- Vorige --}}
                    <a href="?page={{ $currentPage - 1 }}&pageSize={{ $pageSize }}&allergeen={{ request('allergeen') }}"
                       class="px-3 py-1 border rounded-full {{ $currentPage == 1 ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                       ⬅ Vorige
                    </a>

                    {{-- Huidige pagina --}}
                    <span class="px-3 py-1 border rounded-full bg-blue-500 text-white">
                        Pagina {{ $currentPage }}
                    </span>

                    {{-- Volgende --}}
                    <a href="?page={{ $currentPage + 1 }}&pageSize={{ $pageSize }}&allergeen={{ request('allergeen') }}"
                       class="px-3 py-1 border rounded-full {{ count($Allergeens) < $pageSize ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                       Volgende ➡
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
