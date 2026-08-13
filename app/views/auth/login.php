<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../../../public/css/estilos.css">

</head>

<body>

    <div class="login-container">

        <h1>Iniciar sesión</h1>

        <form action="../../../app/controllers/loginController.php" method="POST">

            <input type="email" name="correo" placeholder="Correo electrónico" required>

            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit"> Iniciar sesión </button>

        </form>

        <p> ¿No tienes cuenta?
            <a href="registro.php"> Registrarse </a>
        </p>

    </div>

</body>

</html>