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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err )
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div> 
        @endif

        <form action="{{ route('allergeen.update', $allergeens->Id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="naam" class="form-label">Naam</label>
                <input type="text" class="form-control" id="naam" name="naam" placeholder="Voer de naam in" 
                 value="{{ old('naam',  $allergeens->Naam) }}" required>
            </div>

            <div class="mb-3">
                <label for="omschrijving" class="form-label">Omschrijving</label>
                <input type="text" class="form-control" id="omschrijving" name="omschrijving" placeholder="Voer een omschrijving in" rows="3" 
                value="{{ old( 'omschrijving', $allergeens->Omschrijving) }}"required>
            </div>

            <button type="submit" class="btn btn-primary">Opslaan</button>
            <a href="{{ route('allergeen.index') }}" class="btn btn-secondary">Anuleren</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>