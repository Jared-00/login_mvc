<?php

session_start();

require_once "../models/Usuario.php";

$usuario = new Usuario();

$email = $_POST["email"];
$password = $_POST["password"];

$datosUsuario = $usuario->buscarPorEmail($email);

if ($datosUsuario) {

    if (password_verify($password, $datosUsuario["password"])) {

        $_SESSION["usuario_id"] = $datosUsuario["id"];
        $_SESSION["nombre"] = $datosUsuario["nombre"];
        $_SESSION["email"] = $datosUsuario["email"];

        header("Location: ../views/dashboard/index.php");
        exit();

    } else {

        echo "Contraseña incorrecta";

    }

} else {

    echo "El usuario no existe";

}