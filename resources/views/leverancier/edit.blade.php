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
    <div class="mb-4">
        <h1 class="fw-bold text-primary">{{ $title }}</h1>
        <p class="text-secondary">Leverancier details bewerken</p>
    </div>
    <!-- Card -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header bg-primary bg-gradient text-white fw-semibold fs-5 text-center">
            Leverancier details
        </div>

        <div class="card-body p-0">
            <form method="POST" action="{{ route('leverancier.update', $leverancier->LeverancierId ) }}">
                @csrf
                @method('PUT')

                {{-- Error Messages --}}

                <table class="table table-bordered mb-0 align-middle">
                @if (session('warning'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2 fs-4"></i>

                        <div>
                            <div>{{ session('warning') }}</div>
                            <small>
                                Je wordt over <span id="countdown">3</span> seconden doorgestuurd…
                            </small>
                        </div>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-2 fs-4"></i>

                        <div>
                            <div>{{ session('success') }}</div>
                            <small>
                                Je wordt over <span id="countdown">3</span> seconden doorgestuurd…
                            </small>
                        </div>
                    </div>
                @endif
                    @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-start">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                        <div>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <tbody>
                        <input type="hidden" name="ContactId" value="{{ $leverancier->ContactId }}">
                        <tr>
                            <th class="w-50">Naam</th>
                            <td>
                                <input type="text" class="form-control"
                                       name="Naam"
                                       value="{{ old('Naam', $leverancier->Naam) }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Contactpersoon</th>
                            <td>
                                <input type="text" class="form-control"
                                       name="ContactPersoon"
                                       value="{{ old('ContactPersoon', $leverancier->ContactPersoon) }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Leveranciernummer</th>
                            <td>
                                <input type="text" class="form-control"
                                       name="LeverancierNummer"
                                       value="{{ old('LeverancierNummer', $leverancier->LeverancierNummer) }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Mobiel</th>
                            <td>
                                <input type="tel" class="form-control"
                                       name="Mobiel"
                                       value="{{ old('Mobiel', $leverancier->Mobiel) }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Straatnaam</th>
                            <td>
                                <input type="text" class="form-control"
                                       name="Straat"
                                       value="{{ old('Straat', $leverancier->Straat) }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Huisnummer</th>
                            <td>
                                <input type="number" class="form-control"
                                       name="Huisnummer"
                                       value="{{ old('Huisnummer', $leverancier->Huisnummer) }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Postcode</th>
                            <td>
                                <input type="text" class="form-control"
                                       name="Postcode"
                                       value="{{ old('Postcode', $leverancier->Postcode) }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Stad</th>
                            <td>
                                <input type="text" class="form-control"
                                       name="Stad"
                                       value="{{ old('Stad', $leverancier->Stad) }}">
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Actieknoppen -->
                <div class="d-flex justify-content-between p-4">
                    <button type="submit"
                            class="btn btn-warning rounded-pill px-4 fw-semibold">
                        <i class="bi bi-save me-1"></i> Opslaan
                    </button>

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

            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 text-secondary small">
        © {{ date('Y') }} Jamin Leveranciersportaal
    </footer>
</div>

    <script>
        const countdownElem = document.getElementById('countdown');
        if (countdownElem) {
            let seconds = parseInt(countdownElem.textContent);
            const timer = setInterval(() => {
                seconds--;
                countdownElem.textContent = seconds;
                if (seconds <= 0) {
                    clearInterval(timer);
                    window.location.href = "{{ route('leverancier.show', $leverancier->LeverancierId) }}";
                }
            }, 1000);
        }
    </script>
</body>
</html>
