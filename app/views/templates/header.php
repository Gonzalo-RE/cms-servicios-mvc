<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tituloPagina ?? 'Panel | CMS MVC'; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-main: #000000;
            --bg-card: rgba(22, 22, 23, 0.75);
            --bg-card-hover: rgba(29, 29, 31, 0.85);
            --border-subtle: rgba(255, 255, 255, 0.12);
            --border-focus: #0071e3;
            --text-primary: #f5f5f7;
            --text-secondary: #86868b;
            --accent-blue: #2997ff;
            --accent-green: #30d158;
            --accent-red: #ff453a;
            --accent-amber: #ffd60a;
            --radius-main: 16px;
            --radius-sm: 10px;
            --shadow-apple: 0 12px 40px rgba(0, 0, 0, 0.4);
            --font-apple: 'Inter', -apple-system, BlinkMacSystemFont, "SF Pro Display", "Segoe UI", Roboto, sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font-apple);
            background-color: var(--bg-main);
            color: var(--text-primary);
            padding: 40px 20px;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }
        .contenedor { max-width: 960px; margin: 0 auto; }
        .header-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-subtle);
            padding: 16px 24px;
            border-radius: var(--radius-main);
            margin-bottom: 35px;
            box-shadow: var(--shadow-apple);
        }
        .header-panel span { font-size: 0.95rem; color: var(--text-secondary); }
        .header-panel strong { color: var(--text-primary); font-weight: 600; }
        a.logout { color: var(--accent-red); text-decoration: none; font-size: 0.9rem; font-weight: 500; }
        a.logout:hover { opacity: 0.8; }
        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: -0.022em;
            margin-bottom: 25px;
            text-align: center;
            background: linear-gradient(180deg, #FFFFFF 0%, #86868B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-crear {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #0071e3;
            color: #ffffff;
            padding: 12px 22px;
            text-decoration: none;
            border-radius: 980px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(0, 113, 227, 0.35);
        }
        .btn-crear:hover { background-color: #0077ed; transform: scale(1.02); }
        .btn-editar {
            background-color: rgba(255, 214, 10, 0.15);
            color: var(--accent-amber);
            border: 1px solid rgba(255, 214, 10, 0.3);
            padding: 8px 14px;
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            margin-right: 8px;
        }
        .btn-editar:hover { background-color: rgba(255, 214, 10, 0.25); }
        .btn-eliminar {
            background-color: rgba(255, 69, 58, 0.15);
            color: var(--accent-red);
            border: 1px solid rgba(255, 69, 58, 0.3);
            padding: 8px 14px;
            text-decoration: none;
            border-radius: var(--radius-sm);
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }
        .btn-eliminar:hover { background-color: rgba(255, 69, 58, 0.25); }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; margin-top: 30px; }
        .card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-subtle);
            padding: 28px;
            border-radius: var(--radius-main);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card:hover { background: var(--bg-card-hover); border-color: rgba(255, 255, 255, 0.25); transform: translateY(-4px); }
        .card h3 { font-size: 1.25rem; font-weight: 600; margin-bottom: 10px; color: var(--text-primary); }
        .card p { color: var(--text-secondary); font-size: 0.95rem; line-height: 1.5; margin-bottom: 16px; }
        .precio { color: var(--accent-blue) !important; font-size: 1.35rem !important; font-weight: 700; }
        .campo { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-size: 0.85rem; font-weight: 500; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.05em; }
        input[type="text"], input[type="number"], input[type="password"], textarea {
            width: 100%; padding: 14px 16px; border-radius: var(--radius-sm); border: 1px solid var(--border-subtle); background: rgba(0, 0, 0, 0.5); color: var(--text-primary); font-family: var(--font-apple); font-size: 0.95rem;
        }
        input:focus, textarea:focus { outline: none; border-color: var(--border-focus); box-shadow: 0 0 0 4px rgba(0, 113, 227, 0.25); }
        button[type="submit"] { background: #0071e3; color: white; padding: 14px; border: none; border-radius: var(--radius-sm); font-size: 1rem; font-weight: 600; cursor: pointer; width: 100%; transition: all 0.2s ease; }
        button[type="submit"]:hover { background: #0077ed; transform: scale(1.01); }
        .exito { background: rgba(48, 209, 88, 0.15); color: var(--accent-green); border: 1px solid rgba(48, 209, 88, 0.3); padding: 12px 16px; border-radius: var(--radius-sm); margin-bottom: 20px; font-size: 0.9rem; }
        .error { background: rgba(255, 69, 58, 0.15); color: var(--accent-red); border: 1px solid rgba(255, 69, 58, 0.3); padding: 12px 16px; border-radius: var(--radius-sm); margin-bottom: 20px; font-size: 0.9rem; }
        a.link-volver { color: var(--accent-blue); text-decoration: none; display: inline-block; margin-top: 20px; font-size: 0.9rem; font-weight: 500; }
        a.link-volver:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="contenedor">
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="header-panel">
            <span>Sesión activa: <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Admin'); ?></strong> (<?php echo htmlspecialchars($_SESSION['usuario_rol'] ?? 'cliente'); ?>)</span>
            <a href="index.php?action=logout" class="logout">Cerrar Sesión</a>
        </div>
    <?php endif; ?>