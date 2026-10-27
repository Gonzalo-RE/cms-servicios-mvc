<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

if (isset($_SESSION['usuario_id'])) {
    header("Location: ../../../public/index.php");
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

            header("Location: ../../../public/index.php");
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
    <title>Iniciar Sesion | MVC</title>

    <style>

        body { font-family: Arial, sans-serif; 
            background: #0f172a; 
            color: white; 
            padding: 50px; 
        }

        .box { max-width: 400px; 
            margin: auto; 
            background: #1e293b; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.3); 
        }

        .campo { margin-bottom: 15px; 
        }

        label { display: block; 
            margin-bottom: 5px; 
        }

        input { width: 100%;
            padding: 10px; 
            border-radius: 4px; 
            border: 1px solid #334155; 
            box-sizing: border-box; 
        }

        button { background: #2563eb; 
            color: white; 
            padding: 12px; 
            border: none; 
            border-radius: 4px; 
            width: 100%; 
            cursor: pointer; 
            font-size: 16px; 
            font-weight: bold; 
        }

        button:hover { background: #1d4ed8; 
        }

        .error { background: #7f1d1d; 
            color: #fecaca; 
            padding: 10px; 
            border-radius: 4px; 
            margin-bottom: 15px; 
            text-align: center; 
        }

    </style>

</head>
<body>

   <div class="box">
        <h2 style="text-align: center;">Acceso Administrador</h2>

        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="campo">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required placeholder="admin">
            </div>

            <div class="campo">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit">Ingresar al Panel</button>
        </form>
    </div>
    
</body>
</html>
