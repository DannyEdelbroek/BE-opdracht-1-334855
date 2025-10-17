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

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Barcode</th>
                    <th>Naam</th>
                    <th>Verpakkings Eenheid</th>
                    <th>Aantal Aanwezig</th>
                    <th>Allergeen Info</th>
                    <th>Leverantie Info</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->Barcode }}</td>
                        <td>{{ $product->Naam }}</td>
                        <td>{{ $product->VerpakkingsEenheid }}</td>
                        <td>{{ $product->AantalAanwezig }}</td>
                        <td>
                            <form action="{{ route('producten.index', $product->Naam) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" title="Toon allergenen">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-question" viewBox="0 0 16 16">
                                        <path
                                            d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('leverancier.index', $product->Naam) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm" title="Toon leverancier info">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
