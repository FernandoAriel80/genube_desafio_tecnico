<?php include '../includes/header.php' ?>

<h1>Actualizar Usuario</h1>

<div>
    <div class="div_form">
        <form action="#" method="POST">
            <input type="hidden" name="id" value="<?= $user["id"] ?>">
            <input type="text" name="name" placeholder="Nombre" value="<?= $user["name"] ?>" required>
            <input type="text" name="last_name" placeholder="Apellido" value="<?= $user["last_name"] ?>" required>
            <input type="email" name="email" placeholder="Correo" value="<?= $user["email"] ?>" required>
            <input type="password" name="password" placeholder="Contraseña">
            <input type="password" name="password_confirm" placeholder="Confirmar Contraseña">
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
    .div_form {
        max-width: 400px;
        margin: 0 auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #009879;
        /* Verde principal */
        outline: none;
    }

    input[type="submit"] {
        background-color: #009879;
        /* Verde principal */
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #007f63;
        /* Verde más oscuro */
    }

    .error_li {
        color: red;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .error_li {
        color: red;
    }
</style>


<?php include '../includes/footer.php' ?>