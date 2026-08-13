<?php

// require_once "../../config/database.php";
require_once __DIR__ . "/../../config/database.php";

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $database = new Database();
        $this->conexion = $database->conectar();
    }

    public function buscarPorCorreo($correo) 
    {
        $sql = "SELECT * FROM us_usuarios WHERE us_correo = :correo";
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(":correo", $correo);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre, $email, $telefono, $password, $curp, $rfc, $sexo) //registrar usuario
    { 
        $sql = "INSERT INTO us_usuarios (us_nombre, us_correo, us_telefono, us_pass, us_curp, us_rfc, us_sexo)
                        VALUES (:nombre, :email, :telefono, :password, :curp, :rfc, :sexo)";

        $consulta = $this->conexion->prepare($sql);

        $consulta->bindParam(":nombre", $nombre);
        $consulta->bindParam(":email", $email);
        $consulta->bindParam(":telefono", $telefono);
        $consulta->bindParam(":password", $password);
        $consulta->bindParam(":curp", $curp);
        $consulta->bindParam(":rfc", $rfc);
        $consulta->bindParam(":sexo", $sexo);

        return $consulta->execute();
    }

    public function obtenerUsuarios() //mostrar usuarios 
    {
    $sql = "SELECT us_id, us_nombre, us_correo, us_telefono, us_curp, us_rfc, us_sexo 
            FROM us_usuarios ORDER BY us_id ASC";

    $consulta = $this->conexion->prepare($sql);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT us_id, us_nombre, us_correo, us_telefono, us_curp, us_rfc, us_sexo
                FROM us_usuarios
                WHERE us_id = :id";

        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $correo, $telefono, $curp, $rfc, $sexo)
    {
        $sql = "UPDATE us_usuarios SET us_nombre = :nombre, us_correo = :correo, us_telefono = :telefono, us_curp = :curp, us_rfc = :rfc, us_sexo = :sexo
                    WHERE us_id = :id";
    
        $consulta = $this->conexion->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->bindParam(":nombre", $nombre);
        $consulta->bindParam(":correo", $correo);
        $consulta->bindParam(":telefono", $telefono);
        $consulta->bindParam(":curp", $curp);
        $consulta->bindParam(":rfc", $rfc);
        $consulta->bindParam(":sexo", $sexo);
    
        return $consulta->execute();
    }

    public function contarUsuarios()
    {
        $sql = "SELECT COUNT(*) AS total FROM us_usuarios";
        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }


    public function usuariosPorSexo()
    {
        $sql = "SELECT us_sexo, COUNT(*) AS total
                                        FROM us_usuarios
                                        GROUP BY us_sexo
                                        ORDER BY us_sexo";

        $consulta = $this->conexion->prepare($sql);
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}