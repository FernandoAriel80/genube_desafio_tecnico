<?php
if (!isset($_SESSION["user"])) {
    header("Location: /login");
    exit();
} 
?>
<?php include '../includes/header.php' ?>


<p><?= $users?></p>

<h1>Home</h1>


<?php include '../includes/footer.php' ?>