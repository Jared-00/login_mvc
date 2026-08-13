<?php

class Database
{
    private $host = "127.0.0.1";
    private $port = "5432";
    private $database = "prueba";
    private $username = "postgres";
    private $password = "qwerty";

    public function conectar()
    {
        try {

            $conexion = new PDO(
                "pgsql:host=" . $this->host .
                ";port=" . $this->port .
                ";dbname=" . $this->database,
                $this->username,
                $this->password
            );

            $conexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conexion;

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());

        }
    }
}