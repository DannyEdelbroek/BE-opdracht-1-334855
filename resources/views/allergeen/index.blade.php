<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">{{ $title }}</h1>

        @if (session('success'))
            <div class="alert alert-success" id='S_sms'>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <a href="/allergeen/create" class="btn btn-success mb-3">Nieuwe Allergeen</a>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Naam</th>
                    <th>Omschrijving</th>
                    <th>Verwijderen</th>
                    <th>Wijzig</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allergeen as $allergeens)
                    <tr>
                        <td>{{ $allergeens->Naam }}</td>
                        <td>{{ $allergeens->Omschrijving }}</td>
                        <td>
                            <form action="{{ route('allergeen.destroy', $allergeens->id) }}" method="POST"
                                onsubmit="return confirm('Weet je zeker dat je dit allegeen wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">verwijderen</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('allergeen.edit', $allergeens->id) }}" method="POST">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-primary btn-sm">Wijzigen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
        let successMessage = document.getElementById('S_sms');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = "opacity 0.5s ease";
                successMessage.style.opacity = 0;
                setTimeout(() => successMessage.remove(), 5000); // remove after fade
            }, 4000); // 4 seconds
         clearTimeout
        }
    }); 
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>