<?php
require_once __DIR__ . '/../config/helpers.php';
$title = $title ?? 'Inventario';
?>
<!doctype html>
<html lang="es" class="bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($title) ?></title>
    <script>
        tailwind = { config: { darkMode: 'class' } };
        (function () {
            const saved = localStorage.getItem('inventory-theme');
            const dark = saved ? saved === 'dark' : window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', dark);
        })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .form-input {
            border: 2px solid #64748b !important;
            background-color: #ffffff;
            color: #0f172a;
        }
        .form-input::placeholder { color: #64748b; }
        .form-input:focus {
            border-color: #2563eb !important;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .18);
        }
        .dark .form-input {
            border-color: #94a3b8 !important;
            background-color: #1e293b;
            color: #f8fafc;
        }
        .dark .form-input::placeholder { color: #cbd5e1; }
        .dark .form-input:focus {
            border-color: #60a5fa !important;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, .20);
        }
        .theme-surface { background-color: #ffffff; }
        .dark .theme-surface { background-color: #1e293b; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800 transition-colors dark:bg-slate-950 dark:text-slate-100">
