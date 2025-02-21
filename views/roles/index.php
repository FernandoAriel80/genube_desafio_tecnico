<?php include '../includes/header.php' ?>

<h1>Roles</h1>

<a class="btn-crea-rol" href="/crear-rol">Crear Rol</a>

<div class="div_class">
    <table class="table_roles">
        <thead class="table_thead">
            <tr>
                <td>Rol</td>
                <td>Descripcion</td>
                <td>Acción</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role) { ?>
                <?php if ($role["deleted_at"] == null) { ?>
                    <tr>
                        <td><?= $role["name"] ?></td>
                        <td><?= $role["description"] ?></td>
                        <td>
                            <button class="btn_greed"><a href='/update-rol?id=<?= $role["id"] ?>'>Actualizar</a></button>
                            <button class="btn_red"><a href='/deshabilitar-rol?id=<?= $role["id"] ?>'>Deshabilitar</a></button>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr style="color:red">
                        <td><?= $role["name"] ?></td>
                        <td><?= $role["description"] ?></td>
                        <td>
                            <button class="btn_greed"><a href='/update-rol?id=<?= $role["id"] ?>'>Actualizar</a></button>
                            <button class="btn_blue"><a href='/habilitar-rol?id=<?= $role["id"] ?>'>Habilitar</a></button>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include '../includes/footer.php' ?>

<style>
    .div_class {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Estilos generales para la tabla */
    .table_roles {
        width: auto;
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 18px;
        text-align: left;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    /* Estilos para el encabezado de la tabla */
    .table_roles .table_thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    /* Estilos para las celdas del encabezado y del cuerpo */
    .table_roles th,
    .table_roles td {
        padding: 12px 15px;
    }

    /* Estilos para las filas del cuerpo de la tabla */
    .table_roles tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    /* Estilos para las filas pares */
    .table_roles tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    /* Estilos para la última fila */
    .table_roles tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    button {
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn_greed {
        background-color: #28a745;
    }

    .btn_red {
        background-color: rgb(184, 9, 9);
    }

    .btn_greed:hover {
        background-color: rgb(101, 233, 131);
    }

    .btn_red:hover {
        background-color: rgb(235, 107, 107);
    }

    .btn_blue {
        background-color: blue;
    }

    .btn_blue:hover {
        background-color: rgb(83, 109, 228);
    }

    button a {
        color: white;
        text-decoration: none;
    }

    /* //////////// */
    .btn-crea-rol {
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: rgb(38, 62, 168);
    }

    .btn-crea-rol:hover {
        background-color: rgb(83, 109, 228);
    }
</style>