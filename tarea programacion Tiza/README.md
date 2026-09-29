# Registro de solicitudes de soporte

Este ejemplo permite enviar incidencias con PHP y MySQL. El código está organizado para que la página, las reglas de la solicitud y el acceso a los datos tengan responsabilidades separadas.

## Archivos principales

```text
mi-proyecto/
|-- public/tickets/crear.php       Página de registro
|-- negocio/Ticket.php             Validación de la solicitud
|-- datos/Conexion.php             Conexión MySQL con PDO
|-- datos/TicketRepository.php     Alta en la base
|-- config/config.php              Parámetros de conexión
`-- sql/schema.sql                 Base y datos de muestra
```

## Puesta en marcha

1. Ejecutá `sql/schema.sql` en MySQL para crear la base y la tabla.
2. Definí `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` en el entorno. La base predeterminada se llama `mi_proyecto`.
3. Iniciá el servidor integrado de PHP desde la carpeta del proyecto:

   ```bash
   php -S localhost:8000 -t public
   ```

4. Visitá `http://localhost:8000/tickets/crear.php`.

No guardes claves reales en el repositorio. Usá variables de entorno o una configuración local que Git ignore.

## Cómo se distribuyen las tareas

- `crear.php` presenta los campos, procesa el envío y comunica el resultado.
- `Ticket.php` modela la solicitud, revisa sus datos y define que comienza pendiente.
- `Conexion.php` prepara PDO; `TicketRepository.php` realiza la inserción.

## Preguntas sobre el diseño

### ¿Qué parte se ocupa de la pantalla y de recibir los datos?

Esa tarea corresponde a `public/tickets/crear.php`. El archivo genera el formulario, lee los valores enviados y presenta una confirmación o un aviso de error.

### ¿Dónde se comprueba que la solicitud sea válida?

Las reglas viven en `negocio/Ticket.php`. Allí se limpian los espacios, se exige un asunto y un detalle, y se limita la longitud del asunto.

### ¿Qué archivos se comunican con MySQL?

`datos/Conexion.php` construye la conexión PDO con los valores de configuración. `datos/TicketRepository.php` utiliza esa conexión para guardar la solicitud.

### ¿Por qué la consulta no está escrita dentro de la página?

La página no debería depender de cómo se almacenan los datos. Al dejar el `INSERT` en el repositorio, se mantiene separado el flujo web del mecanismo de persistencia y resulta más sencillo cambiar cada parte por separado.

### ¿Por qué el estado no se elige en el formulario?

El estado forma parte de las reglas del sistema, no de la información que debe decidir quien reporta el problema. Por eso `SolicitudSoporte` establece `pendiente` al crear cada registro y el formulario solo solicita asunto y detalle.