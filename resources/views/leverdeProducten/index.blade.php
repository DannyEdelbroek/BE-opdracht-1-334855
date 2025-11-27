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
        <div class="text-left mb-5">
            <h1 class="display-5 fw-bold text-primary">Geleverde Producten</h1>
            <p class="text-secondary fs-5">Details van producten geleverd door geselecteerde leverancier</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success" id='S_sms'>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (!empty($leverantie))
            {{-- Leverancierinformatie --}}
            <div class="card mb-4 shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white fw-semibold fs-5">
                    Leverancierinformatie
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Naam Leverancier:</strong> {{ $leverantie[0]->LeverancierNaam }}</p>
                            <p class="mb-1"><strong>Contactpersoon:</strong> {{ $leverantie[0]->ContactPersoon }}</p>
                            <p class="mb-1"><strong>LeverancierNr:</strong> {{ $leverantie[0]->LeverancierNummer }}</p>
                            <p class="mb-1"><strong>Mobiel:</strong> {{ $leverantie[0]->Mobiel }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Productentabel -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary bg-gradient text-white text-center fw-semibold fs-5">
                    Productoverzicht
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light">
                            <tr>

                                
                                <th>Naam Product</th>
                                <th>Aantal in magazijn</th>
                                <th>Verpakkingseenheid</th>
                                <th>Laatste levering</th>
                                <th>Nieuwe levering</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leverantie as $item)
                                @if (is_null($item->AantalInMagazijn))
                                    <tr>
                                        <td colspan="5">
                                            <div class="alert alert-danger text-center mb-0 rounded-0">
                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                Dit bedrijf heeft nog geen producten geleverd aan Jamin.
                                                <br>
                                                Je wordt automatisch teruggestuurd in
                                                <span id="countdown" class="fw-bold">3</span> seconden.
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="fw-semibold">{{ $item->ProductNaam }}</td>
                                        <td>{{ $item->AantalInMagazijn }}</td>
                                        <td>{{ $item->VerpakkingsEenheid }}: KG</td>
                                        <td>{{ $item->LaatsteLevering }}</td>
                                        <td>
                                            <a href="{{ route('leverdeProducten.create', [
                                                'leverancierId' => $item->leverancierId,
                                                'productId' => $item->ProductId]) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            <i class="bi bi-plus-circle"></i> Nieuw
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Terugknop -->
        <div class="text-center mt-5">
            <a href="{{ route('leverancier.overzicht') }}" class="btn btn-outline-primary btn-lg rounded-pill px-4">
    <i class="bi bi-arrow-left"></i> Terug naar overzicht
</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Countdown script --}}
    <script>
        const countdownElem = document.getElementById('countdown');
        if (countdownElem) {
            let seconds = parseInt(countdownElem.textContent);
            const timer = setInterval(() => {
                seconds--;
                countdownElem.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(timer);
                    window.location.href = "{{ route('leverancier.overzicht') }}";
                }
            }, 1000);
        }

        document.addEventListener("DOMContentLoaded", function () {
            let successMessage = document.getElementById('S_sms');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = "opacity 0.5s ease";
                    successMessage.style.opacity = 0;
                    setTimeout(() => successMessage.remove(), 5000); // remove after fade
                }, 4000); // 4 seconds
                clearTimeout
            }
        }); 
    </script>

</body>

</html>