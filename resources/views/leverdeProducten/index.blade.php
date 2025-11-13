<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Leveringsinformatie - {{ $productNaam }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <h1 class="mb-4 text-center">Geleverde Poducten</h1>

        @if(!empty($leverantie))
            {{-- Leverancierinformatie --}}
            <div class="mb-4">
                <p><strong>Naam Leverancier:</strong> {{ $leverantie[0]->LeverancierNaam }}</p>
                <p><strong>Contactpersoon:</strong> {{ $leverantie[0]->ContactPersoon }}</p>
                <p><strong>LeverancierNr:</strong> {{ $leverantie[0]->LeverancierNummer }}</p>
                <p><strong>Mobiel:</strong> {{ $leverantie[0]->Mobiel }}</p>
            </div>

            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Naam Product</th>
                        <th>Aantal in magazijn</th>
                        <th>Verpakkingseenheid</th>
                        <th>Laatste levering</th>
                        <th>Nieuwe levering</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leverantie as $item)
                        @if (is_null($item->AantalInMagazijn))
                            <tr>
                                <td colspan="5">
                                    <div class="alert alert-danger text-center mb-0">
                                        Dit bedrijf heeft nu toe geen product geleverd aan jamin
                                        <br>
                                        Je wordt automatisch teruggestuurd in <span id="countdown">3</span> seconden.
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $item->ProductNaam }}</td>
                                <td>{{ $item->AantalInMagazijn }}</td>
                                <td>{{ $item->VerpakkingsEenheid }}</td>
                                <td>{{ $item->LaatsteLevering }}</td>
                                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Terugknop --}}
        <div class="text-center mt-4">
            <a href="/leverancier" class="btn btn-secondary">← Terug naar overzicht</a>
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
    </script>
</body>

</html>