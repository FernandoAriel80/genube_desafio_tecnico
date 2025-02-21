<?php include '../includes/header.php' ?>

<h1>crear usuarios</h1>
<a href="/">ir a home</a>

<div>
    <h1>Registrarse</h1>
    <div class="div_form">
        <form action="/crear-usuario" method="POST">
            <input type="text" name="name" placeholder="Nombre" required>
            <input type="text" name="last_name" placeholder="Apellido" required>
            <input type="text" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="password" name="password_confirm" placeholder="Confirmar Contraseña" required>
            <input type="submit" name="btn_register">
        </form>
        <?php
        if (!empty($errors)) { 
            echo '<ul>'; 
            foreach ($errors as $value) {
                echo '<li class="error_li"">' . $value . '</li>';
            }
            echo '</ul>'; 
        }
        ?>
    </div>
</div>

<style>
    .error_li {
        color: red;
    }
</style>


<?php include '../includes/footer.php' ?>