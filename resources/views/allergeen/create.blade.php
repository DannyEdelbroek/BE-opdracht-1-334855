<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">{{ $title }}</h1>

        <form action="{{ route('allergeen.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="naam" name="Naam" placeholder="Voer de naam in" required>
            </div>

            <div class="mb-3">
                <label for="omschrijving" class="form-label">Omschrijving</label>
                <input class="form-control" id="omschrijving" name="Omschrijving" placeholder="Voer een omschrijving in" rows="3" required>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
