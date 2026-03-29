<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Productdetails
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 w-[700px]">
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <!-- Productinformatie -->
                <dl class="divide-y divide-gray-200 dark:divide-gray-700 space-y-4">
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Naam Product</dt>
                        <dd class="text-gray-900 dark:text-gray-100">{{ $products[0]->Naam }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Barcode</dt>
                        <dd class="text-gray-900 dark:text-gray-100">{{ $products[0]->Barcode }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Bevat gluten</dt>
                        <dd class="text-gray-900 dark:text-gray-100">{{ $products[0]->BevatGluten }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Bevat gelatine</dt>
                        <dd class="text-gray-900 dark:text-gray-100">{{ $products[0]->BevatGelatine }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Bevat AZO-kleurstof</dt>
                        <dd class="text-gray-900 dark:text-gray-100">{{ $products[0]->BevatAZO }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Bevat lactose</dt>
                        <dd class="text-gray-900 dark:text-gray-100">{{ $products[0]->BevatLactose }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="font-medium text-gray-700 dark:text-gray-300">Bevat soja</dt>
                        <dd class="text-gray-900 dark:text-gray-100">{{ $products[0]->BevatSoja }}</dd>
                    </div>
                </dl>

                <!-- Verwijder knop -->
                <div class="mt-6">
                    <form action="{{ route('LeverancierProduct.destroy', $products[0]->Id) }}" method="POST"
                        onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                            Verwijderen
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>