<?php
/* if (!isset($_SESSION["user"])) {
    header("Location: /inicia-sesion");
    exit();
}  */
?>
<?php include '../includes/header.php' ?>

<a href="/ver-roles">cargar roles</a>

<h1>TODOS LOS USUARIOS</h1>

<div class="div_class">

    <table class="table_users">
        <thead class="table_thead">
            <tr>
                <td>ID </td>
                <td> Nombre</td>
                <td> Apellido</td>
                <td> Correo</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr onclick="window.location='/permisos-usuarios?id=<?= $user['id'] ?>';">
                    <td><?= $user["id"] ?></td>
                    <td><?= $user["name"] ?></td>
                    <td><?= $user["last_name"] ?></td>
                    <td><?= $user["email"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<style>
    /* Estilos generales para la tabla */
    .table_users {
        width: 100%;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 18px;
        text-align: left;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    /* Estilos para el encabezado de la tabla */
    .table_users .table_thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    /* Estilos para las celdas del encabezado y del cuerpo */
    .table_users th,
    .table_users td {
        padding: 12px 15px;
    }

    /* Estilos para las filas del cuerpo de la tabla */
    .table_users tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    /* Estilos para las filas pares */
    .table_users tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    /* Estilos para la última fila */
    .table_users tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    /* Efecto hover sobre las filas */
    .table_users tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
</style>

<h1>Home</h1>


<?php include '../includes/footer.php' ?>