<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('LeverancierProduct.index') }}" method="GET">
            @csrf
            @method('GET')
            <div class="flex items-center space-x-4 mt-4">
                <div>
                    <label for="startdatum"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Startdatum:</label>
                    <input type="date" name="startdatum" id="startdatum" value="{{ request('startdatum') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label for="einddatum"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Einddatum:</label>
                    <input type="date" name="einddatum" id="einddatum" value="{{ request('einddatum') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:ring-opacity-50 transition">
                        <i class="bi bi-search mr-2"></i> Max selectie
                    </button>
                </div>
        </form>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Tabel -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    naam Leverancier</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Contact Persoon</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Product Naam</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Stad</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    EinddatumLevering</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Verwijder</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                        {{ $product->LeverancierNaam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                        {{ $product->ContactPersoon }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                        {{ $product->ProductNaam }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                        {{ $product->Stad }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                        {{ $product->EinddatumLevering }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('LeverancierProduct.show', $product->LeverancierId) }}"
                                            class="inline-flex items-center px-3 py-1 border border-blue-500 text-blue-500 rounded-full text-sm font-medium hover:bg-blue-500 hover:text-white transition">
                                            <i class="bi bi-pencil mr-1"></i> X
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-400 dark:text-gray-300">
                                        <i class="bi bi-inbox text-4xl mb-3 block"></i>
                                        <strong>Er zijn geen leveringen geweest van producten van deze periode</strong>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex space-x-2">
                    {{-- Vorige --}}
                    <a href="?page={{ $currentPage - 1 }}&pageSize={{ $pageSize }}&startdatum={{ request('startdatum') }}&einddatum={{ request('einddatum') }}"
                        class="px-3 py-1 border rounded-full {{ $currentPage == 1 ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                        ⬅ Vorige
                    </a>

                    {{-- Huidige pagina --}}
                    <span class="px-3 py-1 border rounded-full bg-blue-500 text-white">
                        Pagina {{ $currentPage }}
                    </span>

                    {{-- Volgende --}}
                    <a href="?page={{ $currentPage + 1 }}&pageSize={{ $pageSize }}&startdatum={{ request('startdatum') }}&einddatum={{ request('einddatum') }}"
                        class="px-3 py-1 border rounded-full {{ count($products) < $pageSize ? 'opacity-50 pointer-events-none' : 'hover:bg-gray-200 dark:hover:bg-gray-700' }}">
                        Volgende ➡
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>