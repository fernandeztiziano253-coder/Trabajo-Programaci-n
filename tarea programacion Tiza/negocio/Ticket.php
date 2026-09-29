<?php

class SolicitudSoporte
{
    private ?int $identificador;
    private string $asunto;
    private string $detalle;
    private string $estado;

    public function __construct(string $asunto, string $detalle, ?int $identificador = null)
    {
        $asunto = trim($asunto);
        $detalle = trim($detalle);

        if ($asunto === '') {
            throw new InvalidArgumentException('Escribí un asunto para continuar.');
        }

        if (mb_strlen($asunto) > 255) {
            throw new InvalidArgumentException('El asunto debe tener como máximo 255 caracteres.');
        }

        if ($detalle === '') {
            throw new InvalidArgumentException('Agregá una descripción del inconveniente.');
        }

        $this->identificador = $identificador;
        $this->asunto = $asunto;
        $this->detalle = $detalle;

        // Cada solicitud ingresa a la cola como pendiente.
        $this->estado = 'pendiente';
    }

    public function getIdentificador(): ?int
    {
        return $this->identificador;
    }

    public function getAsunto(): string
    {
        return $this->asunto;
    }

    public function getDetalle(): string
    {
        return $this->detalle;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }
}