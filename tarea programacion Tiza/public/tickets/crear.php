<?php

require_once __DIR__ . '/../../datos/Conexion.php';
require_once __DIR__ . '/../../negocio/Ticket.php';
require_once __DIR__ . '/../../datos/TicketRepository.php';

$aviso = null;
$resultado = null;
$asunto = '';
$detalle = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $asunto = is_string($_POST['asunto'] ?? null) ? $_POST['asunto'] : '';
    $detalle = is_string($_POST['detalle'] ?? null) ? $_POST['detalle'] : '';

    try {
        $solicitud = new SolicitudSoporte($asunto, $detalle);

        $pdo = ConexionMySql::conectar();
        $repositorio = new SolicitudSoporteRepository($pdo);
        $idNuevo = $repositorio->registrar($solicitud);

        $aviso = "Registramos tu solicitud con el número {$idNuevo}. Estado: {$solicitud->getEstado()}.";
        $resultado = 'correcto';

        $asunto = '';
        $detalle = '';
    } catch (InvalidArgumentException $e) {
        $aviso = $e->getMessage();
        $resultado = 'error';
    } catch (Throwable $e) {
        $aviso = 'No se pudo registrar la solicitud. Probá de nuevo más tarde.';
        $resultado = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva solicitud de soporte</title>
</head>
<body>
    <h1>Nueva solicitud de soporte</h1>

    <?php if ($aviso !== null): ?>
        <p role="status" style="color: <?= $resultado === 'correcto' ? 'green' : 'red' ?>;">
            <?= htmlspecialchars($aviso, ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="asunto">Asunto:</label><br>
        <input
            type="text"
            id="asunto"
            name="asunto"
            value="<?= htmlspecialchars($asunto, ENT_QUOTES, 'UTF-8') ?>"
            required
            maxlength="255"
        ><br><br>

        <label for="detalle">Contanos qué sucede:</label><br>
        <textarea
            id="detalle"
            name="detalle"
            required
            rows="5"
            cols="40"
        ><?= htmlspecialchars($detalle, ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

        <button type="submit">Enviar solicitud</button>
    </form>
</body>
</html>