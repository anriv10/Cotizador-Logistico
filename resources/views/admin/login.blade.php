<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
        body { background: #f9fafb; margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { background: white; border-radius: 16px; border: 1px solid #f0f0f0; box-shadow: 0 1px 3px rgba(0,0,0,0.08); padding: 2rem; width: 100%; max-width: 400px; }
        .logo { width: 48px; height: 48px; background: #2563eb; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
        .title { text-align: center; font-size: 1.4rem; font-weight: 800; color: #111; margin-bottom: 0.25rem; }
        .subtitle { text-align: center; color: #6b7280; font-size: 0.875rem; margin-bottom: 2rem; }
        .label { display: block; font-size: 0.7rem; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
        .input { width: 100%; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 0.75rem 1rem; font-size: 0.875rem; outline: none; color: #111; margin-bottom: 1rem; }
        .input:focus { border-color: #3b82f6; box-shadow: 0 0 0 2px #bfdbfe; }
        .btn { width: 100%; background: #2563eb; color: white; border: none; border-radius: 12px; padding: 0.875rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; margin-top: 0.5rem; }
        .btn:hover { background: #1d4ed8; }
        .error { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; font-size: 0.875rem; border-radius: 10px; padding: 0.75rem 1rem; margin-bottom: 1rem; }
    </style>
</head>
<body>
<div style="width:100%;max-width:400px;padding:1rem;">
    <div class="logo">
        <svg width="28" height="28" fill="none" stroke="white" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
        </svg>
    </div>
    <div class="title">LogísticaMX</div>
    <div class="subtitle">Panel Administrativo</div>

    <div class="card">
        <h2 style="font-size:1.1rem;font-weight:700;color:#111;margin:0 0 1.5rem;">Iniciar Sesión</h2>

        @if($errors->has('credenciales'))
            <div class="error">{{ $errors->first('credenciales') }}</div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <label class="label">Usuario</label>
            <input type="text" name="usuario" value="{{ old('usuario') }}" class="input" placeholder="admin" required autofocus>

            <label class="label">Contraseña</label>
            <input type="password" name="contrasena" class="input" placeholder="••••••••" required>

            <button type="submit" class="btn">Entrar al Panel</button>
        </form>
    </div>
</div>
</body>
</html>
