<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bicicletas</title>


    <style>
        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            padding: 32px 20px;
            background: #f3f6f4;
            color: #1f2937;
            font-family: Arial, sans-serif;
        }


        .container {
            max-width: 1000px;
            margin: 40px auto;
        }


        .back {
            color: #166a4c;
            text-decoration: none;
            font-weight: bold;
        }


        .back:hover {
            text-decoration: underline;
        }


        h1 {
            margin: 24px 0 8px;
            font-size: 32px;
        }


        .subtitle {
            margin: 0 0 28px;
            color: #64748b;
        }


        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
        }


        .card {
            display: block;
            padding: 24px;
            background: white;
            border: 1px solid #e2e8e5;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
            color: inherit;
            text-decoration: none;
        }


        .card:hover {
            border-color: #83bba5;
            box-shadow: 0 8px 24px rgba(22, 106, 76, 0.12);
        }


        .card:focus-visible {
            outline: 3px solid #166a4c;
            outline-offset: 3px;
        }


        .serial {
            color: #64748b;
            font-size: 13px;
        }


        .model {
            margin: 10px 0 16px;
            font-size: 20px;
        }


        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #edf2f0;
            color: #37564a;
            font-size: 13px;
            font-weight: bold;
        }


        .price {
            margin: 20px 0 0;
            color: #166a4c;
            font-size: 20px;
            font-weight: bold;
        }


        .price span {
            color: #64748b;
            font-size: 14px;
            font-weight: normal;
        }


        .empty {
            padding: 24px;
            background: white;
            border-radius: 16px;
            color: #64748b;
        }
        .pending {
            display: block;
            margin-top: 8px;
            color: #b45309;
            font-size: 13px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@auth
    @include('layouts.navigation')
@else
    @include('layouts.public-navigation')
@endauth
<body>
    <main class="container">
        <a class="back" href="{{ route('dashboard') }}">← Volver al dashboard</a>


        <h1>Nuestras bicicletas</h1>
        <p class="subtitle">Selecciona una bicicleta para ver sus detalles.</p>


        <div class="grid">
            @forelse ($bikes as $bike)
                <a class="card" href="{{ route('bikes.show', $bike) }}">
                    <span class="serial">{{ $bike->serial_number }}</span>
                    <h2 class="model">{{ $bike->model }}</h2>


                    <span class="status">
                        @if (auth()->check() && $bike->has_pending_booking)
                            Reserva pendiente
                            <span class="pending">Tienes una reserva pendiente para esta bicicleta.</span>
                        @else
                            @switch($bike->status)
                                @case('available')
                                    Disponible
                                    @break
                                @case('rented')
                                    Alquilada
                                    @break
                                @case('maintenance')
                                    En mantenimiento
                                    @break
                                @default
                                    {{ $bike->status }}
                            @endswitch
                        @endif
                    </span>


                    <p class="price">
                        {{ number_format($bike->price_per_hour, 2, ',', '.') }} €
                        <span>/ hora</span>
                    </p>
                </a>
            @empty
                <p class="empty">No hay bicicletas disponibles en este momento.</p>
            @endforelse
        </div>
    </main>
</body>

</html>