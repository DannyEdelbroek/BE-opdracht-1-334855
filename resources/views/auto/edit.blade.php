<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('4. Wijzigen voertuiggegevens:') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 border border-gray-200">
                
                <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-8">Wijzigen voertuiggegevens</h3>

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-md text-sm shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('auto.update', $voertuig->VoertuigID) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-3 gap-4 items-start">
                        <label for="InstructeurId" class="text-sm font-medium text-gray-700 pt-2">Instructeur:</label>
                        <div class="col-span-2">
                            <select id="InstructeurId" name="InstructeurId" class="w-full max-w-md rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('InstructeurId') border-red-500 @enderror">
                                @foreach($instructeurs as $ins)
                                    <option value="{{ $ins->Id }}" {{ old('InstructeurId', $voertuig->InstructeurId) == $ins->Id ? 'selected' : '' }}>
                                        {{ $ins->InstructeurNaam }}
                                    </option>
                                @endforeach
                            </select>
                            @error('InstructeurId')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 items-start">
                        <label for="TypeVoertuigId" class="text-sm font-medium text-gray-700 pt-2">Type Voertuig:</label>
                        <div class="col-span-2">
                            <select id="TypeVoertuigId" name="TypeVoertuigId" class="w-full max-w-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('TypeVoertuigId') border-red-500 @enderror">
                                @foreach($types as $type)
                                    <option value="{{ $type->Id }}" {{ old('TypeVoertuigId', $voertuig->TypeVoertuigId) == $type->Id ? 'selected' : '' }}>
                                        {{ $type->TypeVoertuig }}
                                    </option>
                                @endforeach
                            </select>
                            @error('TypeVoertuigId')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 items-start">
                        <label for="Type" class="text-sm font-medium text-gray-700 pt-2">Type:</label>
                        <div class="col-span-2">
                            <input type="text" name="Type" id="Type" value="{{ old('Type', $voertuig->Type) }}" required
                                   class="w-full max-w-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('Type') border-red-500 @enderror">
                            @error('Type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 items-start">
                        <label for="Bouwjaar" class="text-sm font-medium text-gray-700 pt-2">Bouwjaar:</label>
                        <div class="col-span-2">
                            <input type="date" name="Bouwjaar" id="Bouwjaar" value="{{ old('Bouwjaar', $voertuig->Bouwjaar) }}" required readonly
                                   class="w-full max-w-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm @error('Bouwjaar') border-red-500 @enderror">
                            @error('Bouwjaar')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 items-start">
                        <span class="text-sm font-medium text-gray-700 pt-1">Brandstof:</span>
                        <div class="col-span-2">
                            <div class="flex items-center space-x-6">
                                <label class="inline-flex items-center text-sm text-gray-700 cursor-pointer">
                                    <input type="radio" name="Brandstof" value="Diesel" {{ old('Brandstof', $voertuig->Brandstof) == 'Diesel' ? 'checked' : '' }}
                                           class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <span class="ml-2">Diesel</span>
                                </label>
                                
                                <label class="inline-flex items-center text-sm text-gray-700 cursor-pointer">
                                    <input type="radio" name="Brandstof" value="Benzine" {{ old('Brandstof', $voertuig->Brandstof) == 'Benzine' ? 'checked' : '' }}
                                           class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <span class="ml-2">Benzine</span>
                                </label>
                                
                                <label class="inline-flex items-center text-sm text-gray-700 cursor-pointer">
                                    <input type="radio" name="Brandstof" value="Elektrisch" {{ old('Brandstof', $voertuig->Brandstof) == 'Elektrisch' ? 'checked' : '' }}
                                           class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <span class="ml-2">Elektrisch</span>
                                </label>
                            </div>
                            @error('Brandstof')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 items-start">
                        <label for="Kenteken" class="text-sm font-medium text-gray-700 pt-2">Kenteken:</label>
                        <div class="col-span-2">
                            <input type="text" name="Kenteken" id="Kenteken" value="{{ old('Kenteken', $voertuig->Kenteken) }}" required
                                   class="w-full max-w-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm uppercase font-mono @error('Kenteken') border-red-500 @enderror">
                            @error('Kenteken')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 grid grid-cols-3 gap-4 items-center">
                        <div></div>
                        <div class="col-span-2 flex items-center space-x-6">
                            <button type="submit" class="px-10 py-2 border-2 border-gray-800 hover:bg-gray-800 hover:text-white font-bold text-gray-900 rounded shadow-sm transition-colors text-sm uppercase tracking-wider">
                                Wijzig
                            </button>
                            <a href="{{ route('auto.show', $voertuig->InstructeurId) }}" class="text-sm text-gray-500 hover:text-gray-700 underline">
                                Annuleren
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>