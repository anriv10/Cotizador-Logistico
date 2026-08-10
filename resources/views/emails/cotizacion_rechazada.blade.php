<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Cotización Rechazada</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6; background-color: #f9f9f9; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h2 style="color: #dc3545; margin-top: 0;">Actualización de Solicitud</h2>
        <p>Hola <strong>{{ $cotizacion->cliente_nombre }}</strong>,</p>
        
        <p>Te informamos que tu solicitud de cotización para la ruta de <strong>{{ $cotizacion->origen }}</strong> a <strong>{{ $cotizacion->destino }}</strong> ha sido rechazada.</p>
        
        <p>Lamentablemente, en este momento no nos es posible procesar o cubrir las especificaciones de este servicio de logística.</p>
        
        <p style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; border-left: 4px solid #dc3545;">
            <strong>Estatus actual:</strong> Esta cotización ha sido rechazada por el administrador.
        </p>

        <p>Si consideras que hubo un error o deseas realizar una nueva solicitud con diferentes especificaciones, puedes ponerte en contacto directo respondiendo a este mismo correo electrónico.</p>
        
        <br>
        <p style="margin-bottom: 0;">Atentamente,</p>
        <p style="margin-top: 5px; font-weight: bold; color: #2563eb;">Logística MX</p>
    </div>
</body>
</html>
