<?php include '../includes/header.php' ?>

<h1>index de usuarios con roles</h1>
<a href="/">ir a home</a>
<br>
<!-- <a href="/asignar-permisos">asignar permisos al usuario</a> -->
<br>

<div>
    <?php foreach ($roles as $role) { ?>
        <input type="checkbox" id="checks" name="vehicle1" value="Bike">
        <tr>
            <td><?= $role["name"] ?></td>
            <td><?= $role["description"] ?></td>
        </tr>
    <?php } ?>
</div>

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
            <tr>
                <td><?= $user["id"] ?></td>
                <td><?= $user["name"] ?></td>
                <td><?= $user["last_name"] ?></td>
                <td><?= $user["email"] ?></td>
            </tr>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php' ?>