<?php include '../includes/header.php' ?>

<h1>actualizar rol</h1>
<a href="/">ir a home</a>



<div class="form-container">
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $role["id"] ?>">
        <input type="text" class="name" name="name" placeholder="Nombre del rol" value="<?= $role["name"] ?>" required>
        <input type="text" class="description" name="description" placeholder="Descripción del rol" value="<?= $role["description"] ?>" required>
        <input type="submit" class="btn_create_role" name="btn_create_role" value="Guardar">
    </form>
</div>

<?php
if (!empty($errors)) { // Verifica si el array no está vacío
    echo '<ul>'; // Abre una lista no ordenada
    foreach ($errors as $value) {
        echo '<li class="error_li"">' . $value . '</li>';
    }
    echo '</ul>'; // Cierra la lista
}
?>

<?php include '../includes/footer.php' ?>

<style>
    /* Estilos generales */
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 20px;
    }

    /* Contenedor del formulario */
    .form-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Estilos para los inputs */
    .form-container input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }

    .form-container input[type="text"]:focus {
        border-color: #009879;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 152, 121, 0.5);
    }

    /* Estilo para el botón */
    .form-container .btn_create_role {
        width: 100%;
        padding: 12px;
        background-color: #009879;
        color: #ffffff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .form-container .btn_create_role:hover {
        background-color: #007f63;
    }

    /* Placeholder */
    .form-container input::placeholder {
        color: #999;
    }

<?php include '../includes/footer.php' ?>