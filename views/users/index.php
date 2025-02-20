<?php include '../includes/header.php' ?>

<h1>Índice de Usuarios con Roles</h1>
<a href="/">Ir a Home</a>

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

                    <?php if ($role_id["is_assigned"] == 0) { ?>
                        <label>
                            <input type="hidden" name="user_id" value="<?= $id ?>">
                            <input type="checkbox" name="roles[]" value="<?= $role_id["role_id"] ?>">
                            <?= $role_id["name"] ?> - <?= $role_id["description"] ?>
                        </label>
                        <br>
                    <?php } ?>
                <?php } ?>

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
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Roles</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($current_user["roles"])) { ?>
                <tr>
                    <td><?= $user_roles["id"] ?></td>
                    <td><?= $user_roles["name"] ?></td>
                    <td><?= $user_roles["last_name"] ?></td>
                    <td><?= $user_roles["email"] ?></td>
                    <td>No tiene roles</td>
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

<?php include '../includes/footer.php' ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h1 {
        color: #333;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    form {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    label {
        display: block;

        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    .div_class {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .table_users {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table_users th,
    .table_users td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table_users th {
        background-color: #009879;
        color: white;
    }
</style>