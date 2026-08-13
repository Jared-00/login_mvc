<?php

session_start();

require_once "../models/Usuario.php";

$usuario = new Usuario();

$correo = $_POST["correo"];
// $correo = isset($_POST["correo"])
//     ? $_POST["correo"]
//     : "";
$password = $_POST["password"];

// $password = isset($_POST["password"])
//     ? $_POST["password"]
//     : "";

$datosUsuario = $usuario->buscarPorCorreo($correo);

if ($datosUsuario) {

    if (password_verify($password, $datosUsuario["us_pass"])) {

        $_SESSION["usuario_id"] = $datosUsuario["us_id"];
        $_SESSION["nombre"] = $datosUsuario["us_nombre"];
        $_SESSION["correo"] = $datosUsuario["us_correo"];

        header("Location: ../views/dashboard/index.php");
        exit();

    } else {
        echo "Contraseña incorrecta";
    }

} else {

    echo "El usuario no existe";

}