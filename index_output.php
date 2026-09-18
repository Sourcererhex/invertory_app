<?php

declare(strict_types=1);
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/helpers.php';

session_start();

if (!empty($_SESSION['ID'])) {
    redirect('/dashboard.php');
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['USUARIO'] ?? '');
    $password = $_POST['PASSWORD'] ?? '';

    if ($usuario === '' || $password === '') {
        $error = 'Complete usuario y contraseña.';
    } else {
        $stmt = db()->prepare('SELECT ID, USUARIO, PASSWORD, TIPO_USUARIO FROM usuarios WHERE USUARIO = ? LIMIT 1');
        $stmt->execute([$usuario]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['PASSWORD'])) {
            session_regenerate_id(true);
            $_SESSION['ID'] = $user['ID'];
            $_SESSION['USUARIO'] = $user['USUARIO'];
            $_SESSION['TIPO_USUARIO'] = $user['TIPO_USUARIO'];
            redirect('/dashboard.php');
        }

        $error = 'Usuario o contraseña incorrectos.';
    }
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Inicio de sesión</title>
    <script>
        tailwind = {
            config: {
                darkMode: 'class'
            }
        };
        (function() {
            const saved = localStorage.getItem('inventory-theme');
            const dark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', dark);
        })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .form-input {
            border: 2px solid #64748b !important;
            background: #fff;
            color: #0f172a;
        }

        .form-input:focus {
            border-color: #2563eb !important;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .18);
        }

        .dark .form-input {
            border-color: #94a3b8 !important;
            background: #1e293b;
            color: #f8fafc;
        }

        .dark .form-input:focus {
            border-color: #60a5fa !important;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, .2);
        }
    </style>
</head>

<body>
    <main>
        <button type="button" id="loginThemeToggle" aria-label="Cambiar tema"><span id="loginThemeIcon">🌙</span></button>
        <h1>INICIO</h1>
        <p>Sistema de inventario</p>

        <?php if ($error): ?>
            <div><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <div>
                <label for="USUARIO">Usuario</label>
                <input
                    id="USUARIO" name="USUARIO" type="text" required>
            </div>
            <div>
                <label for="PASSWORD">Contraseña</label>
                <input
                    id="PASSWORD" name="PASSWORD" type="password" required>
            </div>
            <button>
                INGRESAR
            </button>
        </form>
    </main>
    <script>
        (function() {
            const root = document.documentElement,
                b = document.getElementById('loginThemeToggle'),
                i = document.getElementById('loginThemeIcon');

            function u() {
                i.textContent = root.classList.contains('dark') ? '☀️' : '🌙';
            }
            u();
            b.addEventListener('click', function() {
                const d = root.classList.toggle('dark');
                localStorage.setItem('inventory-theme', d ? 'dark' : 'light');
                u();
            });
        })();
    </script>
</body>

</html>