<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="div_register">
        <h1>Registrarse</h1>
        <div class="div_form">
            <form class="form_register" action="#" method="post">
                <input class="name" type="text" name="name" placeholder="Nombre">
                <input class="last_name" type="text" name="last_name" placeholder="Apellido">
                <input class="email" type="text" name="email" placeholder="Correo">
                <input class="password" type="password" name="password" placeholder="Contraseña">
                <input class="password_confirm" type="password" name="password_confirm" placeholder="Confirmar Contraseña">
                <input class="btn_register" type="submit" name="btn_register">
            </form>
            <?php
            if (!empty($errors)) { // Verifica si el array no está vacío
                echo '<ul>'; // Abre una lista no ordenada
                foreach ($errors as $value) {
                    echo '<li class="error_li"">' . $value . '</li>';
                }
                echo '</ul>'; // Cierra la lista
            }
            ?>


            <a href="/inicia-sesion">Inicia sesión</a>
        </div>
    </div>
</body>

</html>

<style>
.error_li {
    color: red;
}
</style>