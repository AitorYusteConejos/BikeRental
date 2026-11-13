<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservar bicicleta</title>


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
            background: #fff;
            border: 1px solid #e2e8e5;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }


        .eyebrow {
            color: #64748b;
            font-size: 14px;
        }


        h1 {
            margin: 8px 0 24px;
            font-size: 28px;
        }


        .bike-info {
            padding: 18px;
            background: #f3f6f4;
            border-radius: 10px;
        }


        .bike-info p {
            margin: 6px 0;
        }


        .price {
            color: #166a4c;
            font-weight: bold;
        }


        .field {
            margin-top: 24px;
        }


        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }


        input[type="datetime-local"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5d0;
            border-radius: 8px;
            color: #1f2937;
            font: inherit;
        }


        input:focus {
            outline: 2px solid #83bba5;
            outline-offset: 2px;
        }


        .button {
            width: 100%;
            margin-top: 28px;
            padding: 14px 20px;
            border: 0;
            border-radius: 10px;
            background: #166a4c;
            color: white;
            font: inherit;
            font-weight: bold;
            cursor: pointer;
        }


        .button:hover {
            background: #10533b;
        }


        .button:focus-visible,
        .back:focus-visible {
            outline: 3px solid #166a4c;
            outline-offset: 4px;
        }


        .errors {
            margin-top: 24px;
            padding: 16px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #991b1b;
        }


        .errors p {
            margin: 0 0 8px;
            font-weight: bold;
        }


        .errors ul {
            margin: 0;
            padding-left: 20px;
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
        <a class="back" href="{{ route('bikes.show', $bike) }}">
            ← Volver a la bicicleta
        </a>


        <section class="card">
            <span class="eyebrow">Nueva reserva</span>
            <h1>Reserva tu {{ $bike->model }}</h1>


            <div class="bike-info">
                <p>Número de serie: <strong>{{ $bike->serial_number }}</strong></p>
                <p class="price">
                    {{ number_format($bike->price_per_hour, 2, ',', '.') }} € / hora
                </p>
            </div>


            @if ($errors->any())
                <div class="errors" role="alert">
                    <p>Revisa los datos de la reserva:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf


                <input type="hidden" name="bike_id" value="{{ $bike->id }}">


                <div class="field">
                    <label for="start_time">Fecha y hora de inicio</label>
                    <input
                        type="datetime-local"
                        id="start_time"
                        name="start_time"
                        value="{{ old('start_time') }}"
                        required
                    >
                </div>


                <div class="field">
                    <label for="end_time">Fecha y hora de devolución</label>
                    <input
                        type="datetime-local"
                        id="end_time"
                        name="end_time"
                        value="{{ old('end_time') }}"
                        required
                    >
                </div>


                <button class="button" type="submit">
                    Confirmar reserva
                </button>
            </form>
        </section>
    </main>
</body>
</html>