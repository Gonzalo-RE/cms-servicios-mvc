<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/database.php';

if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php?action=index");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($usuario) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['usuario'];
            $_SESSION['usuario_rol'] = $user['rol'] ?? 'cliente';

            header("Location: index.php?action=index");
            exit;
        } else {
            $error = "❌ Usuario o contraseña incorrectos.";
        }
    } else {
        $error = "⚠️ Ingresa tu usuario y contraseña.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | CMS MVC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #000000;
            color: #f5f5f7;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            background: rgba(22, 22, 23, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 36px;
            border-radius: 18px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }
        h2 { text-align: center; margin-bottom: 24px; font-weight: 700; font-size: 1.8rem; }
        .campo { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-size: 0.85rem; color: #86868b; text-transform: uppercase; letter-spacing: 0.05em; }
        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(0, 0, 0, 0.5);
            color: #f5f5f7;
            font-size: 0.95rem;
        }
        input:focus { outline: none; border-color: #0071e3; box-shadow: 0 0 0 4px rgba(0, 113, 227, 0.25); }
        button {
            background: #0071e3;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 10px;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        button:hover { background: #0077ed; transform: scale(1.01); }
        .error { background: rgba(255, 69, 58, 0.15); color: #ff453a; border: 1px solid rgba(255, 69, 58, 0.3); padding: 12px; border-radius: 10px; margin-bottom: 20px; font-size: 0.9rem; text-align: center; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Acceso Panel</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="index.php?action=login" method="POST">
        <div class="campo">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required placeholder="admin">
        </div>

        <div class="campo">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>

        <button type="submit">Ingresar</button>
    </form>
</div>

</body>
</html>