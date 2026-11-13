<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle de bicicleta</title>


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
            max-width: 600px;
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


        .card {
            margin-top: 24px;
            padding: 32px;
            background: white;
            border: 1px solid #e2e8e5;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }


        .label {
            color: #64748b;
            font-size: 14px;
        }


        h1 {
            margin: 8px 0 16px;
            font-size: 28px;
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


        .details {
            margin-top: 28px;
            border-top: 1px solid #e5e7eb;
        }


        .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 18px 0;
            border-bottom: 1px solid #e5e7eb;
        }


        .price {
            color: #166a4c;
            font-size: 20px;
            font-weight: bold;
        }


        .button {
            display: block;
            margin-top: 28px;
            padding: 14px 20px;
            border-radius: 10px;
            background: #166a4c;
            color: white;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
        }


        .button:hover {
            background: #10533b;
        }


        .button:focus-visible,
        .back:focus-visible {
            outline: 3px solid #166a4c;
            outline-offset: 4px;
        }


        .unavailable {
            margin: 28px 0 0;
            padding: 14px;
            border-radius: 10px;
            background: #f3f4f6;
            color: #64748b;
            text-align: center;
        }
    </style>
</head>
<body>
    <main class="container">
        <a class="back" href="{{ route('bikes.index') }}">
            ← Volver a las bicicletas
        </a>


        <article class="card">
            <span class="label">Detalle de bicicleta</span>
            <h1>{{ $bike->model }}</h1>


            <span class="status">
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
            </span>


            <div class="details">
                <div class="row">
                    <span class="label">Número de serie</span>
                    <strong>{{ $bike->serial_number }}</strong>
                </div>


                <div class="row">
                    <span class="label">Precio por hora</span>
                    <span class="price">
                        {{ number_format($bike->price_per_hour, 2, ',', '.') }} €
                    </span>
                </div>
            </div>


            @if ($bike->status === 'available')
                <a class="button" href="{{ route('bookings.create', $bike) }}">
                    Reservar esta bicicleta
                </a>
            @else
                <p class="unavailable">
                    Esta bicicleta no está disponible para reservar.
                </p>
            @endif
        </article>
    </main>
</body>
</html>