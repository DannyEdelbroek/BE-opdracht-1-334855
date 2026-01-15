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
            <p class="text-secondary fs-5">Overzicht van alle leveranciers</p>
        </div>

        <!-- Card -->
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-header bg-primary bg-gradient text-white text-center fw-semibold fs-5">
                Leveranciersoverzicht
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Naam</th>
                                <th>Contactpersoon</th>
                                <th>Leveranciernummer</th>
                                <th>Mobiel</th>
                                <th>Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($leveranties as $leverantie)
                                <tr>
                                    <td class="fw-semibold">{{ $leverantie->Naam }}</td>
                                    <td>{{ $leverantie->ContactPersoon }}</td>
                                    <td>{{ $leverantie->LeverancierNummer }}</td>
                                    <td>{{ $leverantie->Mobiel }}</td>
                                    <td>
                                        <a href="{{ route('leverancier.show', $leverantie->Id) }}"
                                            class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                        <strong>Geen leveranciers gevonden</strong><br>
                                        Er zijn nog geen leveranciers toegevoegd.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
                <p>Huidige pagina: {{ $currentPage }}</p>
                <p>PageSize: {{ $pageSize }}</p>

                @foreach($leveranties as $leverantie)
                    <p>{{ $leverantie->Naam }} (ID: {{ $leverantie->Id }})</p>
                @endforeach
                <button>Terug</button> <button>Volgende</button>
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