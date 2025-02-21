<nav class="navbar">

    <a href="/" class="navbar-brand">Inicio</a>

    <!-- Menú de navegación (opcional) -->
    <ul class="navbar-nav">
        <li><a href="/ver-roles">Cargar Roles</a></li>
        <li><a href="/crear-usuario">Cargar Usuario</a></li>
    </ul>

</nav>

<style>
    .navbar {
        background-color: #009879;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

    }


    .navbar-brand {
        color: white;
        font-size: 24px;
        font-weight: bold;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }

    .navbar-brand:hover {
        opacity: 0.8;

    }


    .navbar-nav {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .navbar-nav li {
        margin-left: 20px;
    }

    .navbar-nav a {
        color: white;
        text-decoration: none;
        font-size: 16px;
        transition: opacity 0.3s ease;
    }

    .navbar-nav a:hover {
        opacity: 0.8;

    }
    a {
        text-decoration: none;
    }
</style>