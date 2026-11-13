<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle de reserva</title>


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
            font-weight: bold;
            text-decoration: none;
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


        .eyebrow, .label {
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
            width: 100%;
            margin-top: 28px;
            padding: 14px 20px;
            border: 0;
            border-radius: 10px;
            background: #b42318;
            color: white;
            font: inherit;
            font-weight: bold;
            cursor: pointer;
        }


        .button:hover {
            background: #8f1b13;
        }


        .message {
            margin-top: 20px;
            padding: 14px;
            border-radius: 10px;
            background: #fef2f2;
            color: #991b1b;
        }


        a:focus-visible, button:focus-visible {
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
        <a class="back" href="{{ route('bookings.index') }}">
            ← Volver a mis reservas
        </a>


        <article class="card">
            <span class="eyebrow">Reserva #{{ $booking->id }}</span>
            <h1>{{ $booking->bike->model }}</h1>


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


            @if (session('error'))
                <p class="message" role="alert">{{ session('error') }}</p>
            @endif


            <div class="details">
                <div class="row">
                    <span class="label">Número de serie</span>
                    <strong>{{ $booking->bike->serial_number }}</strong>
                </div>


                <div class="row">
                    <span class="label">Inicio</span>
                    <strong>{{ $booking->start_time }}</strong>
                </div>


                <div class="row">
                    <span class="label">Devolución prevista</span>
                    <strong>{{ $booking->end_time }}</strong>
                </div>


                <div class="row">
                    <span class="label">Coste total</span>
                    <span class="price">
                        {{ number_format($booking->total_cost, 2, ',', '.') }} €
                    </span>
                </div>
            </div>


            @if ($booking->status === 'pending')
                <form
                    action="{{ route('bookings.cancel', $booking) }}"
                    method="POST"
                    onsubmit="return confirm('¿Quieres cancelar esta reserva?')"
                >
                    @csrf
                    @method('PATCH')


                    <button class="button" type="submit">
                        Cancelar reserva
                    </button>
                </form>
            @endif
        </article>
    </main>
</body>
</html>