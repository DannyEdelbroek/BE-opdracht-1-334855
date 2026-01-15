<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container py-5">

    <h2 class="fw-bold mb-4">{{ $title }}</h2>

    <div class="card shadow-sm rounded-4">
        @if (session('success'))
            <div id="S_sms" class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill me-2 fs-4"></i>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="card-body p-0">

            <table class="table table-bordered mb-0">
                <tbody>
                    <tr>
                        <th class="w-50">Naam</th>
                        <td>{{ $leverancier->Naam }}</td>
                    </tr>
                    <tr>
                        <th>Contactpersoon</th>
                        <td>{{ $leverancier->ContactPersoon }}</td>
                    </tr>
                    <tr>
                        <th>Leveranciernummer</th>
                        <td>{{ $leverancier->LeverancierNummer }}</td>
                    </tr>
                    <tr>
                        <th>Mobiel</th>
                        <td>{{ $leverancier->Mobiel }}</td>
                    </tr>
                    <tr>
                        <th>Straatnaam</th>
                        <td>{{ $leverancier->Straat }}</td>
                    </tr>
                    <tr>
                        <th>Huisnummer</th>
                        <td>{{ $leverancier->Huisnummer }}</td>
                    </tr>
                    <tr>
                        <th>Postcode</th>
                        <td>{{ $leverancier->Postcode }}</td>
                    </tr>
                    <tr>
                        <th>Stad</th>
                        <td>{{ $leverancier->Stad }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <!-- Actieknoppen -->
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('leverancier.edit', $leverancier->LeverancierId) }}"
           class="btn btn-warning rounded-pill px-4">
            <i class="bi bi-pencil"></i> Wijzig
        </a>

        <div class="d-flex gap-2">
            <a href="{{ route('leverancier.overzichten') }}"
               class="btn btn-secondary rounded-pill px-4">
                Terug
            </a>

            <a href="{{ route('home') }}"
               class="btn btn-outline-dark rounded-pill px-4">
                Home
            </a>
        </div>
    </div>

</body>


