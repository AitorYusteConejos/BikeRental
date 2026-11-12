<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bicicletas</title>
</head>
<body>
    <h1>Lista de Bicicletas</h1>

    <ul>
        @forelse ($bikes as $bike)
            <li>
                {{ $bike->serial_number }} - {{ $bike->model }} - {{ $bike->price_per_hour }} - {{ $bike->status }}
            </li>
        @empty
            <li>No hay bicicletas disponibles.</li>
        @endforelse
    </ul>
</body>
</html>