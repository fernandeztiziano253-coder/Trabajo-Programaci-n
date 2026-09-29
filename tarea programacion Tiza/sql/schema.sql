CREATE DATABASE IF NOT EXISTS mi_proyecto
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE mi_proyecto;

CREATE TABLE IF NOT EXISTS solicitud_soporte (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    asunto VARCHAR(255) NOT NULL,
    detalle TEXT NOT NULL,
    estado VARCHAR(50) NOT NULL DEFAULT 'pendiente',
    fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO solicitud_soporte (asunto, detalle, estado) VALUES
('Acceso a la cuenta', 'La página no reconoce mi contraseña.', 'pendiente'),
('Pedido de equipamiento', 'Solicito una computadora portátil para mis tareas.', 'pendiente');