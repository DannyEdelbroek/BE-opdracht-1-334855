<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Allergenen - {{ $productNaam }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">

        <h1 class="mb-4 text-center">
            Allergenenoverzicht voor: <span class="text-primary">{{ $productNaam }}</span>
        </h1>

        {{-- Toon productinformatie --}}
        @if (count($allergenen) > 0)
            <div class="mb-4">
                   <p><strong>Productnaam</strong>
                    {{ $allergenen[0]->NaamProduct }}</p>
                    <p><strong>Barcode</strong>
                    {{ $allergenen[0]->Barcode }}</p>
            <div>

            {{-- Toon allergenenlijst --}}
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Allergeen Naam</th>
                        <th>Omschrijving</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allergenen as $item)
                        <tr>
                            <td>{{ $item->AllergeenNaam }}</td>
                            <td>{{ $item->AllergeenOmschrijving }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning text-center">
                Geen allergenen gevonden voor dit product.
                <br>
                Je wordt automatisch teruggestuurd in <span id="countdown">4</span> seconden.
            </div>
        @endif

        {{-- Terugknop --}}
        <div class="text-center mt-4">
            <a href="/magazijn" class="btn btn-secondary">← Terug naar overzicht</a>
        </div>

    </div> {{-- sluit de container netjes af --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
