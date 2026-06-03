<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle voertuigen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="mb-5 bg-indigo-50 border border-indigo-100 rounded-lg p-4 max-w-xs shadow-sm">
                <p class="text-sm font-medium text-indigo-900">
                    Aantal voertuigen:
                    <span class="ml-1 text-base font-bold text-indigo-600 bg-indigo-100 px-2.5 py-0.5 rounded-full">
                        {{ $voertuigen->count() }}
                    </span>
                </p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-md text-sm shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md text-sm shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Type voertuig</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Type</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Kenteken</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Bouwjaar</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Brandstof</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Rijbewijscategorie</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Instructeur naam</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Verwijderen</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($voertuigen as $voertuig)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $voertuig->VoertuigID ?? $voertuig->Id ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $voertuig->TypeVoertuig ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $voertuig->Type ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-mono">
                                        {{ $voertuig->Kenteken ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $voertuig->Bouwjaar ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $voertuig->Brandstof ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $voertuig->RijbewijsCategorie ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $voertuig->InstructeurNaam ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <form action="{{ route('auto.destroy', ['id' => $voertuig->VoertuigID]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Weet je zeker dat je dit voertuig wilt verwijderen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 inline-block p-1.5 hover:bg-red-50 rounded-md transition-colors"
                                                title="Verwijder voertuig">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500">Geen voertuigen
                                        gevonden.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>