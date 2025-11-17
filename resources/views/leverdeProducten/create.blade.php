<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Leveringsinformatie - {{ $productNaam }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light bg-gradient">

    <div class="container py-5">

        <!-- Titel -->
        <div class="text-center mb-5">
            <h1 class="flex-start display-5 fw-bold text-primary">Levering Product</h1>
        </div>

        @if(!empty($leverantie))
            {{-- Leverancierinformatie --}}
            <div class="card mb-4 shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white fw-semibold fs-5">
                    Leverancierinformatie
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Naam Leverancier:</strong> {{ $leverantie[0]->Naam }}</p>
                            <p class="mb-1"><strong>Contactpersoon:</strong> {{ $leverantie[0]->ContactPersoon }}</p>
                            <p class="mb-1"><strong>LeverancierNr:</strong> {{ $leverantie[0]->LeverancierNummer }}</p>
                            <p class="mb-1"><strong>Mobiel:</strong> {{ $leverantie[0]->Mobiel }}</p>
                            <p><strong>Product:</strong> {{ $productNaam }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                Geen leverancierinformatie beschikbaar.
            </div>
        @endif



        <div class="mt-5">

            <form action="{{ route('leverancier.store') }}" method="POST">
                @csrf

                <!-- Leverancier (readonly) -->
                <input type="hidden" name="LeverancierId" value="{{ $leverancierId }}">

                <!-- Product -->
                <input type="hidden" name="ProductId" value="{{ $productId }}">


                <!-- Aantal -->
                <div class="mb-3">
                    <label for="AantalProductHeden" class="form-label">Aantal geleverd</label>
                    <input type="number" class="form-control" id="AantalProductHeden" name="AantalProductHeden"
                        required>
                </div>
                @error('AantalProductHeden')
                    <p class="text-danger text-uppercase font-weight-bold">{{ $message }}</p>
                @enderror

                <!-- Datum volgende levering -->
                <div class="mb-3">
                    <label for="DatumEerstvolgendeLevering" class="form-label">
                        Datum eerstvolgende levering
                    </label>
                    <input type="date" class="form-control" id="DatumEerstvolgendeLevering"
                        name="DatumEerstvolgendeLevering" required>
                </div>
                @error('DatumEerstvolgendeLevering')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary">Opslaan</button>
            </form>
            <div class="d-flex justify-content-end mt-5">
                <a href="{{ route('leverdeProducten.index', ['leverdeProduct' => $leverancierId]) }}"
                    class="btn btn-outline-primary btn-lg rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Terug
                </a>

                <a href="{{ route('leverancier.overzicht') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Home
                </a>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>