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

<body class="flex min-h-screen items-center justify-center bg-slate-200 px-4 text-slate-800 transition-colors dark:bg-slate-950 dark:text-slate-100">
    <main class="relative w-full max-w-md rounded-2xl bg-white p-8 shadow-xl dark:bg-slate-900">
        <button type="button" id="loginThemeToggle" class="absolute right-4 top-4 rounded-lg border border-slate-300 px-3 py-2 hover:bg-slate-100 dark:border-slate-600 dark:hover:bg-slate-800" aria-label="Cambiar tema"><span id="loginThemeIcon">🌙</span></button>
        <h1 class="mb-2 text-center text-3xl font-bold">INICIO</h1>
        <p class="mb-6 text-center text-slate-500 dark:text-slate-400">Sistema de inventario</p>

        <?php if ($error): ?>
            <div class="mb-4 rounded border border-red-300 bg-red-50 p-3 text-red-700"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="post" class="space-y-5">
            <div>
                <label class="mb-1 block font-medium" for="USUARIO">Usuario</label>
                <input class="form-input w-full rounded-lg px-4 py-3"
                    id="USUARIO" name="USUARIO" type="text" required>
            </div>
            <div>
                <label class="mb-1 block font-medium" for="PASSWORD">Contraseña</label>
                <input class="form-input w-full rounded-lg px-4 py-3"
                    id="PASSWORD" name="PASSWORD" type="password" required>
            </div>
            <button class="w-full rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white hover:bg-blue-700">
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