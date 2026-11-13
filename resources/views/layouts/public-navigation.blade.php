<nav class="public-nav">
    <div class="public-nav__content">
        <a href="{{ route('welcome') }}">Inicio</a>
        <a href="{{ route('bikes.index') }}">Bicicletas</a>


        <div class="public-nav__account">
            <a href="{{ route('login') }}">Iniciar sesión</a>
            <a href="{{ route('register') }}">Registrarse</a>
        </div>
    </div>
</nav>


<style>
    .public-nav {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        font-family: Arial, sans-serif;
    }


    .public-nav__content {
        display: flex;
        align-items: center;
        gap: 24px;
        max-width: 1100px;
        margin: 0 auto;
        padding: 20px;
    }


    .public-nav a {
        color: #166a4c;
        font-weight: bold;
        text-decoration: none;
    }


    .public-nav__account {
        display: flex;
        gap: 20px;
        margin-left: auto;
    }


    @media (max-width: 600px) {
        .public-nav__content,
        .public-nav__account {
            flex-wrap: wrap;
        }
    }
</style>