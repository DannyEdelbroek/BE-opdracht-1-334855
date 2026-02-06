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
        <!-- Filter dropdown -->
        <form method="GET" class="d-flex gap-3 mb-4">
            <select name="allergeen" class="form-select rounded-pill" onchange="this.form.submit()">
                <option value="">Alle allergenen</option>
                @foreach ($AllergeenNamen as $item)
                    <option value="{{ $item->AllergeenNaam }}" {{ request('allergeen') == $item->AllergeenNaam ? 'selected' : '' }}>
                        {{ $item->AllergeenNaam }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Tabel -->
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ProductNaam</th>
                    <th>AllergeenNaam</th>
                    <th>AantalAanwezig</th>
                    <th>Omschrijving</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Allergeens as $Allergeen)
                    <tr>
                        <td>{{ $Allergeen->ProductNaam }}</td>
                        <td>{{ $Allergeen->AllergeenNaam }}</td>
                        <td>{{ $Allergeen->AantalAanwezig }}</td>
                        <td>{{ $Allergeen->Omschrijving }}</td>
                        <td>
                            <a href="{{ route('leverancier.showLeverancier', $Allergeen->LeverancierId) }}"
                                class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            <strong>Geen informatie gevonden op dit moment</strong>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Pagina navigatie">
            <ul class="pagination mt-3">

                {{-- Vorige pagina --}}
                <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="?page={{ $currentPage - 1 }}&pageSize={{ $pageSize }}&allergeen={{ request('allergeen') }}"
                        tabindex="-1">
                        ⬅ Vorige
                    </a>
                </li>

                {{-- Huidige pagina --}}
                <li class="page-item active">
                    <span class="page-link">
                        Pagina {{ $currentPage }}
                    </span>
                </li>

                {{-- Volgende pagina --}}
                <li class="page-item {{ count($Allergeens) < $pageSize ? 'disabled' : '' }}">
                    <a class="page-link"
                        href="?page={{ $currentPage + 1 }}&pageSize={{ $pageSize }}&allergeen={{ request('allergeen') }}">
                        Volgende ➡
                    </a>
                </li>

            </ul>
        </nav>

    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 text-secondary small">
        © {{ date('Y') }} Jamin Leveranciersportaal
    </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>