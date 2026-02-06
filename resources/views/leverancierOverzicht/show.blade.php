<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light bg-gradient">
    <div class="container py-5">

        <!-- Header -->
        <div class="mb-5">
            <h1 class="fw-bold display-5 text-primary mb-2">{{ $title }}</h1>
        </div>



        <!-- Card -->
        <div class="card border-0 shadow-lg rounded-4">

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Naam Leverancier</th>
                                <th>Contactpersoon</th>
                                <th>Mbiel</th>
                                <th>Stad</th>
                                <th>Straat</th>
                                <th>Huisnummer</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($leverancier as $item)

                                @if (is_null($item->Stad) && is_null($item->Straat) && is_null($item->Huisnummer))
                                    <tr>
                                        <td class="fw-semibold">{{ $item->LeverancierNaam }}</td>
                                        <td>{{ $item->ContactPersoon }}</td>
                                        <td>{{ $item->Mobiel }}</td>

                                        <!-- Samengevoegde kolommen -->
                                        <td colspan="3" class="text-center text-muted fst-italic">
                                            Er zijn geen adresgegevens bekend
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="fw-semibold">{{ $item->LeverancierNaam }}</td>
                                        <td>{{ $item->ContactPersoon }}</td>
                                        <td>{{ $item->Mobiel }}</td>
                                        <td>{{ $item->Stad }}</td>
                                        <td>{{ $item->Straat }}</td>
                                        <td>{{ $item->Huisnummer }}</td>
                                    </tr>
                                @endif

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                        Geen leveranciers gevonden
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>


                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center mt-5 text-secondary small">
            © {{ date('Y') }} Jamin Leveranciersportaal
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>