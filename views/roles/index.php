<?php include '../includes/header.php' ?>

<h1>index de roles</h1>
<a href="/">ir a home</a>
<br>
<a href="/crear-rol">crear rol</a>

<div class="div_class">
    <table class="table_roles">
        <thead class="table_thead">
            <tr>
                <td>Rol</td>
                <td>Descripcion</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role) { ?>
                <tr>
                    <td><?= $role["name"] ?></td>
                    <td><?= $role["description"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include '../includes/footer.php' ?>

<style>
    .div_class{
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

    /* Efecto hover sobre las filas */
   /*  .table_roles tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    } */
</style>