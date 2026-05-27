<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Door Instructeur gebruikte voertuigen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-md text-sm shadow-sm">
                        {{ session('success') }}
                    </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">
                
                @if($instructeur)
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
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
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
                    <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        Toevoegen Voertuig
                    </a>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type Voertuig</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kenteken</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Bouwjaar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Brandstof</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Rijbewijscategorie</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Wijzigen</th>
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
                                            <a href="{{ route('auto.edit', ['id' => $voertuig->VoertuigID]) }}" class="text-indigo-600 hover:text-indigo-900 inline-block p-1.5 hover:bg-indigo-50 rounded-md transition-colors" title="Wijzig voertuig">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500 bg-gray-50/50">
                                        Deze instructeur heeft momenteel geen voertuigen toegewezen gekregen.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <a href="{{ route('auto.index') }}" class="text-indigo-600 hover:text-indigo-900 inline-block p-1.5 hover:bg-indigo-50 rounded-md transition-colors" title="Terug naar overzicht">
                        Terug
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>