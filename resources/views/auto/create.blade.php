<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Alle beschikbare voertuigen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">

                @if($instructeur)
                    <div class="space-y-2 mb-8 bg-gray-50 p-4 rounded-lg border border-gray-100 max-w-xl shadow-sm">
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold inline-block w-36 text-gray-600">Naam:</span>
                            {{ $instructeur->InstructeurNaam }}
                        </p>
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold inline-block w-36 text-gray-600">Datum in dienst:</span>
                            {{ \Carbon\Carbon::parse($instructeur->DatumInDienst)->format('d-m-Y') }}
                        </p>
                        <p class="text-sm text-gray-700 flex items-center">
                            <span class="font-semibold inline-block w-36 text-gray-600">Aantal sterren:</span>
                            <span class="flex text-amber-500 ml-1">
                                @if($instructeur->AantalSterren > 0)
                                    @for($i = 0; $i < $instructeur->AantalSterren; $i++)
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                    @endfor
                                @else
                                    <span class="text-gray-400 italic text-xs">Geen sterren</span>
                                @endif
                            </span>
                        </p>
                    </div>
                @else
                    <div class="mb-8 p-4 bg-red-50 text-red-700 rounded-lg border border-red-100">
                        Geen instructeurgegevens gevonden.
                    </div>
                @endif

                <div class="mb-6">
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Type Voertuig</th>
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
                                    class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Rijbewijscategorie</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Toevoegen</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($voertuigen as $voertuig)
                                @if($voertuig->VoertuigID)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                            {{ $voertuig->TypeVoertuig }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $voertuig->Type }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                            <span class="bg-gray-100 px-2 py-1 rounded border border-gray-200">
                                                {{ $voertuig->Kenteken }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($voertuig->Bouwjaar)->format('d-m-Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $voertuig->Brandstof }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                {{ $voertuig->RijbewijsCategorie }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <form action="{{ route('auto.store') }}" method="POST">
                                                @csrf
                                                {{-- // Voeg verborgen velden toe voor VoertuigId en InstructeurId --}}
                                                <input type="hidden" name="VoertuigId" value="{{ $voertuig->VoertuigID }}">
                                                <input type="hidden" name="InstructeurId" value="{{ $instructeur->InstructeurId }}">
                                                
                                                <button type="submit" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-50 text-green-600 hover:bg-green-100 hover:text-green-700 transition-colors" title="Voertuig toewijzen">
                                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500 bg-gray-50/50">
                                        Geen vrije voertuigen beschikbaar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('auto.index') }}"
                        class="text-indigo-600 hover:text-indigo-900 inline-block p-1.5 hover:bg-indigo-50 rounded-md transition-colors"
                        title="Terug naar overzicht">
                        Terug
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>