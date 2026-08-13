<?php

    session_start();

    if (!isset($_SESSION["usuario_id"])) {

        header("Location: ../auth/login.php");
        exit();

    }

    require_once "../../models/Usuario.php";

    $usuarioModel = new Usuario();

    $id = isset($_GET["id"]) ? $_GET["id"] : null;

    if (!$id) {

        echo "ID de usuario no proporcionado.";
        exit();

    }

    $usuario = $usuarioModel->buscarPorId($id);

    if (!$usuario) {

        echo "Usuario no encontrado.";
        exit();

    }

?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Editar usuario</title>

</head>

<body>

    <h1>Editar usuario</h1>

    <form action="../../controllers/UsuarioController.php" method="POST">

        <input type="hidden" name="accion" value="editar">

        <input type="hidden" name="us_id" value="<?php echo $usuario["us_id"]; ?>">

        <label>Nombre:</label>

        <input type="text" name="nombre" value="<?php echo $usuario["us_nombre"]; ?>" required >

        <br><br>

        <label>Correo:</label>

        <input type="email" name="correo" value="<?php echo $usuario["us_correo"]; ?>" required>

        <br><br>

        <label>Teléfono:</label>

        <input type="tel" name="telefono" value="<?php echo $usuario["us_telefono"]; ?>" maxlength="10" required>

        <br><br>

        <label>CURP:</label>

        <input type="text" name="curp" value="<?php echo $usuario["us_curp"]; ?>" maxlength="18" pattern="[A-Za-z]{4}[0-9]{6}[A-Za-z]{6}[A-Za-z0-9][0-9]" title="La CURP debe tener 18 caracteres con formato válido" oninput="this.value = this.value.toUpperCase()"  required>

        <br><br>

        <label>RFC:</label>

        <input type="text" name="rfc" value="<?php echo $usuario["us_rfc"]; ?>" maxlength="13" pattern="[A-Za-zÑñ&]{3,4}[0-9]{6}[A-Za-z0-9]{3}" title="El RFC debe tener entre 12 y 13 caracteres con formato válido" oninput="this.value = this.value.toUpperCase()" required>

        <br><br>

        <label>Sexo:</label>

        <select name="sexo" required>

            <option value="">Selecciona</option>

            <option value="Masculino"
                <?php echo ($usuario["us_sexo"] == "Masculino") ? "selected" : ""; ?>>
                Masculino
            </option>

            <option value="Femenino"
                <?php echo ($usuario["us_sexo"] == "Femenino") ? "selected" : ""; ?>>
                Femenino
            </option>

            <option value="Otro"
                <?php echo ($usuario["us_sexo"] == "Otro") ? "selected" : ""; ?>>
                Otro
            </option>

        </select>

        <br><br>

        <button type="submit">
            Guardar cambios
        </button>

    </form>

    <br>

    <a href="index.php">
        Regresar
    </a>

</body>

</html>