<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Leveringsinformatie - {{ $productNaam }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <h1 class="mb-4 text-center">Leveringsinformatie</h1>

        @if(!empty($leverantie))
            {{-- Leverancierinformatie --}}
            <div class="mb-4">
                <p><strong>Naam Leverancier:</strong> {{ $leverantie[0]->NaamLeverancier }}</p>
                <p><strong>Contactpersoon Leverancier:</strong> {{ $leverantie[0]->ContactpersoonLeverancier }}</p>
                <p><strong>Leverancier Nummer:</strong> {{ $leverantie[0]->LeverancierNummer }}</p>
                <p><strong>Mobiel:</strong> {{ $leverantie[0]->Mobiel }}</p>
            </div>

            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Naam Product</th>
                        <th>Datum laatste levering</th>
                        <th>Aantal</th>
                        <th>Eerstvolgende levering</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leverantie as $item)
                        @if (is_null($item->AantalAanwezig))
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-danger text-center mb-0">
                                        De verwachte eerstvolgende levering is: 30-04-2023.
                                        <br>
                                        Je wordt automatisch teruggestuurd in <span id="countdown">4</span> seconden.
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $item->NaamProduct }}</td>
                                <td>{{ $item->DatumLaatsteLevering }}</td>
                                <td>{{ $item->Aantal }}</td>
                                <td>{{ $item->EerstvolgendeLevering }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Terugknop --}}
        <div class="text-center mt-4">
            <a href="/magazijn" class="btn btn-secondary">← Terug naar overzicht</a>
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
                    window.location.href = "{{ route('magazijn.index') }}";
                }
            }, 1000);
        }
    </script>
</body>

</html>
