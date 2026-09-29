<?php

require_once __DIR__ . '/../negocio/Ticket.php';

class SolicitudSoporteRepository
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    public function registrar(SolicitudSoporte $solicitud): int
    {
        $consulta = 'INSERT INTO solicitud_soporte (asunto, detalle, estado)
                     VALUES (:asunto, :detalle, :estado)';

        $sentencia = $this->conexion->prepare($consulta);
        $sentencia->bindValue(':asunto', $solicitud->getAsunto(), PDO::PARAM_STR);
        $sentencia->bindValue(':detalle', $solicitud->getDetalle(), PDO::PARAM_STR);
        $sentencia->bindValue(':estado', $solicitud->getEstado(), PDO::PARAM_STR);
        $sentencia->execute();

        return (int) $this->conexion->lastInsertId();
    }
}