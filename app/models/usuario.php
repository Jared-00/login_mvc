<?php

require_once "../../config/database.php";

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function buscarPorEmail($email) 
    {
        $sql = "SELECT * FROM us_usuarios WHERE us_correo = :email";

        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(":email", $email);

        $consulta->execute();

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $email, $telefono, $password) //registrar usuario
    { 
        $sql = "INSERT INTO us_usuarios (us_nombre, us_correo, us_telefono, us_apellidos)
                        VALUES (:nombre, :email, :telefono, :password)";

        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(":nombre", $nombre);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":telefono", $telefono);
        $consulta->bindParam(":password", $password);

        return $consulta->execute();
    }
}