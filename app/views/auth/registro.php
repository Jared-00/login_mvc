<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../../../public/css/estilos.css">
</head>

<body>

    <div class="login-container">

        <h1>Crear cuenta</h1>

        <form action="../../../app/controllers/usuarioController.php" method="POST">

            <input type="text" name="nombre" placeholder="Nombre" required>

            <input type="email" name="correo" placeholder="Correo electrónico" required>

            <input type="tel" name="telefono" placeholder="Teléfono" maxlength="10" pattern="[0-9]{10}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required >

            <input type="password" name="password" placeholder="Contraseña" required>

            <button type="submit"> Registrarme </button>

        </form>

        <p>
            ¿Ya tienes cuenta?
            <a href="login.php"> Iniciar sesión </a>
        </p>

    </div>

</body>

</html>