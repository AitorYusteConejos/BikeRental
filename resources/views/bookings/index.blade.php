<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mis reservas</title>


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
            max-width: 900px;
            margin: 40px auto;
        }


        .back {
            color: #166a4c;
            font-weight: bold;
            text-decoration: none;
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


        .message {
            padding: 14px 18px;
            border-radius: 10px;
            background: #e3f5eb;
            color: #166a4c;
        }


        .list {
            display: grid;
            gap: 16px;
        }


        .card {
            padding: 24px;
            background: white;
            border: 1px solid #e2e8e5;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
        }


        .card h2 {
            margin: 8px 0 16px;
            font-size: 21px;
        }


        .serial, .label {
            color: #64748b;
            font-size: 14px;
        }


        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #edf2f0;
            color: #37564a;
            font-size: 14px;
            font-weight: bold;
        }


        .price {
            color: #166a4c;
            font-size: 20px;
            font-weight: bold;
        }


        .detail-link {
            display: inline-block;
            margin-top: 8px;
            color: #166a4c;
            font-weight: bold;
        }


        a:focus-visible {
            outline: 3px solid #166a4c;
            outline-offset: 4px;
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
        <a class="back" href="{{ route('bikes.index') }}">
            ← Volver al catálogo
        </a>


        <h1>Mis reservas</h1>
        <p class="subtitle">Consulta el estado y las fechas de tus reservas.</p>


        @if (session('success'))
            <p class="message">{{ session('success') }}</p>
        @endif


        <div class="list">
            @forelse ($bookings as $booking)
                <article class="card">
                    <span class="serial">
                        {{ $booking->bike->serial_number }}
                    </span>


                    <h2>{{ $booking->bike->model }}</h2>


                    <span class="status">
                        @switch($booking->status)
                            @case('pending')
                                Pendiente
                                @break
                            @case('active')
                                Activa
                                @break
                            @case('completed')
                                Completada
                                @break
                            @case('cancelled')
                                Cancelada
                                @break
                            @default
                                {{ $booking->status }}
                        @endswitch
                    </span>


                    <p>
                        <span class="label">Inicio:</span>
                        {{ $booking->start_time }}
                    </p>


                    <p>
                        <span class="label">Devolución prevista:</span>
                        {{ $booking->end_time }}
                    </p>


                    <p class="price">
                        {{ number_format($booking->total_cost, 2, ',', '.') }} €
                    </p>


                    <a class="detail-link" href="{{ route('bookings.show', $booking) }}">
                        Ver detalle de la reserva →
                    </a>
                </article>
            @empty
                <div class="card">
                    <p>Todavía no tienes reservas.</p>
                    <a href="{{ route('bikes.index') }}">Ver bicicletas</a>
                </div>
            @endforelse
        </div>
    </main>
</body>
</html>