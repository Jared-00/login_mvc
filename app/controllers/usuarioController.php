<?php

require_once "../models/Usuario.php";

$usuario = new Usuario();

$accion = isset($_POST["accion"])
    ? $_POST["accion"]
    : "registrar";

/* =========================
   EDITAR USUARIO
   ========================= */
   
   if ($accion == "editar") {

    $id = $_POST["us_id"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $curp = strtoupper(trim($_POST["curp"]));
    $rfc = strtoupper(trim($_POST["rfc"]));
    $sexo = $_POST["sexo"];

    // =============================
    // VALIDACIÓN CURP
    // =============================

    if (!preg_match(
        '/^[A-Z]{4}[0-9]{6}[A-Z]{6}[A-Z0-9][0-9]$/',
        $curp
    )) {
        die("Error: La CURP no tiene un formato válido.");
    }

    // =============================
    // VALIDACIÓN RFC
    // =============================

    if (!preg_match(
        '/^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$/',
        $rfc
    )) {
        die("Error: El RFC no tiene un formato válido.");
    }

    try {
        $usuario->actualizar($id, $nombre, $correo, $telefono, $curp, $rfc, $sexo);
        header("Location: ../views/dashboard/index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error al actualizar usuario: "
            . $e->getMessage();
    }

}


/* =========================
   REGISTRAR USUARIO
   ========================= */

else {

        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $password = $_POST["password"];
        $curp = strtoupper(trim($_POST["curp"]));
        $rfc = strtoupper(trim($_POST["rfc"]));
        $sexo = $_POST["sexo"];

        // =============================
        // VALIDACIÓN CURP
        // =============================

        if (!preg_match(
            '/^[A-Z]{4}[0-9]{6}[A-Z]{6}[A-Z0-9][0-9]$/',
            $curp
        )) {
            die("Error: La CURP no tiene un formato válido.");
        }

        // =============================
        // VALIDACIÓN RFC
        // =============================

        if (!preg_match(
            '/^[A-ZÑ&]{3,4}[0-9]{6}[A-Z0-9]{3}$/',
            $rfc
        )) {

            die("Error: El RFC no tiene un formato válido.");

        }
        // =============================
        // HASH DE CONTRASEÑA
        // =============================

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        try {

            $usuario->registrar(
                $nombre,
                $correo,
                $telefono,
                $passwordHash,
                $curp,
                $rfc,
                $sexo
            );

            header("Location: ../views/auth/login.php");
            exit();

        } catch (PDOException $e) {

            echo "Error al registrar usuario: " . $e->getMessage();

        }
    }