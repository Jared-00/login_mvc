<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {

    header("Location: ../auth/login.php");

    exit();

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Dashboard</title>

</head>

<body>

    <h1>
        Bienvenido,
        <?php echo $_SESSION["nombre"]; ?>
    </h1>

    <p>
        Has iniciado sesión correctamente.
    </p>

    <p>
        Correo:
        <?php echo $_SESSION["email"]; ?>
    </p>

    <a href="../../controllers/LogoutController.php">
        Cerrar sesión
    </a>

</body>

</html>