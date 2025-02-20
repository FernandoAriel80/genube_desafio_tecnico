<?php include '../includes/header.php' ?>

<h1>index de usuarios con roles</h1>
<a href="/">ir a home</a>

<div>
    <form action="/asignar-permisos" method="post">
        <?php if (!empty($current_user["roles"])) { ?>
            <div>
                <?php foreach ($user_roles["roles"] as $role_id) { ?>
                    <?php if ($role_id["is_assigned"] == 1) { ?>
                        <label>
                            <input type="hidden" name="user_id" value="<?= $id ?>">
                            <input type="checkbox" name="roles[]" value="<?= $role_id["role_id"] ?>" checked>
                            <?= $role_id["name"] ?> - <?= $role_id["description"] ?>
                        </label>
                        <br>
                    <?php } ?>

                    <!-- //////////////////// -->
                    <?php if ($role_id["is_assigned"] == 0) { ?>
                        <label>
                            <input type="hidden" name="user_id" value="<?= $id ?>">
                            <input type="checkbox" name="roles[]" value="<?= $role_id["role_id"] ?>">
                            <?= $role_id["name"] ?> - <?= $role_id["description"] ?>
                        </label>
                        <br>
                    <?php } ?>
                <?php } ?>
                <!-- //////////////// -->
                <?php foreach ($roles as $role) { ?>
                    <?php if (!in_array($role['id'], $role_db)) { ?>
                        <label>
                            <input type="hidden" name="user_id" value="<?= $id ?>">
                            <input type="checkbox" name="roles[]" value="<?= $role['id'] ?>">
                            <?= $role["name"] ?> - <?= $role["description"] ?>
                        </label>
                        <br>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div>
                <!-- //////////////// -->
                <?php foreach ($roles as $role) { ?>        
                        <label>
                            <input type="hidden" name="user_id" value="<?= $id ?>">
                            <input type="checkbox" name="roles[]" value="<?= $role['id'] ?>">
                            <?= $role["name"] ?> - <?= $role["description"] ?>
                        </label>
                        <br>
                <?php } ?>
            </div>
        <?php } ?>
        <input type="submit" value="Guardar">
    </form>
</div>

<div class="div_class">

    <table class="table_users">
        <thead class="table_thead">
            <tr>
                <td>ID </td>
                <td> Nombre</td>
                <td> Apellido</td>
                <td> Correo</td>
                <td>Roles</td>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($current_user["roles"])) { ?>
                <tr>
                    <td><?= $user_roles["id"] ?></td>
                    <td><?= $user_roles["name"] ?></td>
                    <td><?= $user_roles["last_name"] ?></td>
                    <td><?= $user_roles["email"] ?></td>
                    <td>
                        No tiene roles
                    </td>
                </tr>
            <?php } else { ?>
                <tr>
                    <td><?= $user_roles["user"]["id"] ?></td>
                    <td><?= $user_roles["user"]["name"] ?></td>
                    <td><?= $user_roles["user"]["last_name"] ?></td>
                    <td><?= $user_roles["user"]["email"] ?></td>
                    <td>
                        <?php foreach ($user_roles["roles"] as $role) {
                            if ($role["is_assigned"] == 1) {
                                echo " " . $role["name"];
                            }
                        } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php //var_dump($user_model); 
?>
<?php include '../includes/footer.php' ?>