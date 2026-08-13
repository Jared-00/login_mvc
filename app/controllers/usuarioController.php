<?php

require_once "../models/Usuario.php";

$usuario = new Usuario();

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$password = $_POST["password"];

$passwordHash = password_hash(
    $password,
    PASSWORD_DEFAULT
);

try {

    $usuario->registrar(
        $nombre,
        $correo,
        $telefono,
        $passwordHash
        // $password

    );

    header("Location: ../views/auth/login.php");

} catch (PDOException $e) {

    echo "Error al registrar usuario: " . $e->getMessage();

}