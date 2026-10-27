<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Biodata')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #d9d9d9; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4 d-print-none">
        <div class="container">
            <a class="navbar-brand" href="{{ route('biodata.index') }}">Biodata CRUD</a>
            <a href="{{ route('biodata.create') }}" class="btn btn-light btn-sm">+ Tambah Biodata</a>
        </div>
    </nav>

    <div class="container pb-5">
        @if (session('success'))
            <div class="alert alert-success d-print-none">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger d-print-none">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
