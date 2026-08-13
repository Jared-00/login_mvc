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

            <input type="text" id="curp" name="curp" maxlength="18" placeholder="CURP" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z]{6}[A-Za-z0-9][0-9]" title="La CURP debe tener 18 caracteres con formato válido" oninput="this.value = this.value.toUpperCase()"  required>

            <input type="text" id="rfc" name="rfc" maxlength="13" placeholder="RFC" pattern="[A-Za-zÑñ&]{3,4}[0-9]{6}[A-Za-z0-9]{3}" title="El RFC debe tener entre 12 y 13 caracteres con formato válido" oninput="this.value = this.value.toUpperCase()" required>

            <select id="sexo" name="sexo" required>

                <option value="">Selecciona una opción</option>

                <option value="Masculino">Masculino</option>

                <option value="Femenino">Femenino</option>

                <option value="Otro">Otro</option>

            </select>

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