<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $tituloPagina ?? 'Panel de Control | MVC'; ?></title>
    <style>
        body { font-family: Arial, sans-serif; 
            background: #0f172a; 
            color: white; 
            padding: 30px; 
            margin: 0; 
        }

        .contenedor { max-width: 900px; 
            margin: auto; 
        }

        .header-panel { display: flex; 
            justify-content: space-between; 
            align-items: center; 
            background: #1e293b; 
            padding: 15px 20px; 
            border-radius: 8px; 
            margin-bottom: 30px; 
        }

        a.logout { color: #f87171; 
            text-decoration: none; 
            font-weight: bold; 
        }

        .grid { display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 20px; 
        }
        
        .card { background: #1e293b; 
            padding: 20px; 
            border-radius: 8px; 
            border: 1px solid #334155; 
        }

        .precio { color: #38bdf8; 
            font-size: 1.25rem; 
            font-weight: bold; 
        }

        .btn-crear { display: inline-block; 
            background: #10b981;
            color: white; 
            padding: 10px 20px; 
            text-decoration: none; 
            border-radius: 5px; 
            font-weight: bold; 
        }

        .btn-editar { background-color: #f59e0b; 
            color: white; 
            padding: 6px 12px; 
            text-decoration: none; 
            border-radius: 4px; 
            font-size: 0.85rem; 
            font-weight: bold; 
            margin-right: 5px; 
        }
        
        .btn-eliminar { background-color: #ef4444; 
            color: white; 
            padding: 6px 12px; 
            text-decoration: none; 
            border-radius: 4px; 
            font-size: 0.85rem; 
            font-weight: bold; 
        }

        .campo { margin-bottom: 15px;
        }

        label { display: block; 
            margin-bottom: 5px; 
        }

        input, textarea { width: 100%;
        padding: 10px; 
        border-radius: 4px; 
        border: 1px solid #334155; 
        box-sizing: border-box; 
        background: #0f172a; 
        color: white; 
    }

        button { background: #2563eb; 
            color: white; 
            padding: 12px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            width: 100%; 
            font-size: 16px; 
            font-weight: bold; 
        }

        button:hover { background: #1d4ed8; 
        }

        .exito { background: #064e3b; 
            color: #a7f3d0; 
            padding: 10px; 
            border-radius: 4px; 
            margin-bottom: 15px; 
        }

        .error { background: #7f1d1d; 
            color: #fecaca; 
            padding: 10px; 
            border-radius: 4px; 
            margin-bottom: 15px; 
        }

            a.link-volver { color: #38bdf8; 
            text-decoration: none; 
            display: inline-block; 
            margin-top: 15px; 
        }
    </style>
</head>
<body>

<div class="contenedor">
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="header-panel">
            <span>
                Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['usuario_nombre'] ?? 'Usuario'); ?></strong>
                <span class="badge-rol"><?php echo htmlspecialchars($_SESSION['usuario_rol'] ?? 'cliente'); ?></span>
            </span>
            <a href="../logout.php" class="logout">Cerrar Sesión</a>
        </div>
    <?php endif; ?>