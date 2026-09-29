<?php

class ConexionMySql
{
    public static function conectar(): PDO
    {
        $config = require __DIR__ . '/../config/config.php';
        $servidor = $config['mysql'];

        $dsn = "mysql:host={$servidor['servidor']};port={$servidor['puerto']};dbname={$servidor['base']};charset={$servidor['juego_caracteres']}";

        return new PDO($dsn, $servidor['usuario'], $servidor['clave'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }
}