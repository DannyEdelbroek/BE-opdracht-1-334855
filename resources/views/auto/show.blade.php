<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Door Instructeur gebruikte voertuigen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Succes meldingen vanuit de sessie --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-md text-sm shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Foutmeldingen vanuit de sessie --}}
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md text-sm shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">

                @if($instructeur)
                    {{-- Blok met Instructeur Gegevens --}}
                    <div class="space-y-2 mb-8 bg-gray-50 p-4 rounded-lg border border-gray-100 max-w-xl shadow-sm">
                        <p class="text-sm text-gray-700">
                            <span class="font-semibold inline-block w-36 text-gray-600">Naam:</span>
                            {{ $instructeur->Voornaam }}
                            @if($instructeur->Tussenvoegsel) {{ $instructeur->Tussenvoegsel }} @endif
                            {{ $instructeur->Achternaam }}
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

                    {{-- Controleer of de instructeur niet bereikbaar/actief is --}}
                    {{-- Controleer of de instructeur NIET actief is --}}
                    @if(isset($instructeur->IsActief) && $instructeur->IsActief == 0)
                        {{-- Toon de gele waarschuwing, GEEN knop --}}
                        <div
                            class="mb-6 p-4 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-md text-sm shadow-sm font-medium">
                            Op het moment is de instructeur niet bereikbaar. Het toevoegen van voertuigen is niet mogelijk.
                        </div>
                    @else
                        {{-- Instructeur is WEL actief: Toon de werkende knop --}}
                        <div class="mb-6">
                            <a href="{{ route('auto.create', ['Id' => $instructeur->Id ?? $instructeur->InstructeurID]) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Toevoegen Voertuig
                            </a>
                        </div>
                    @endif

                    {{-- Overzichtstabel Voertuigen --}}
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
                                        Wijzigen</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                        Verwijderen</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($voertuigen as $voertuig)
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
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                {{ $voertuig->RijbewijsCategorie }}
                                            </span>
                                        </td>

                                        {{-- Wijzig Actie --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('auto.edit', ['id' => $voertuig->VoertuigID]) }}"
                                                class="text-indigo-600 hover:text-indigo-900 inline-block p-1.5 hover:bg-indigo-50 rounded-md transition-colors"
                                                title="Wijzig voertuig">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </td>

                                        {{-- Verwijder Actie --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <form action="{{ route('auto.destroyAll', ['id' => $voertuig->VoertuigID]) }}"
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
                                    {{-- Lege tabel fallback --}}
                                    <tr>
                                        <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500 bg-gray-50/50">
                                            Deze instructeur heeft momenteel geen voertuigen toegewezen gekregen.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    {{-- Foutmelding als de complete instructeur variabele leeg is --}}
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md text-sm shadow-sm">
                        Er is geen instructeur gevonden met deze gegevens.
                    </div>
                @endif

                {{-- Algemene Terug-knop --}}
                <div class="mt-6">
                    <a href="{{ route('auto.index') }}"
                        class="text-indigo-600 hover:text-indigo-900 font-medium inline-flex items-center text-sm">
                        &larr; Terug naar overzicht
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>