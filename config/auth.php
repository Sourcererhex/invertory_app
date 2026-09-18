<?php
declare(strict_types=1);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function require_login(): void
{
    if (empty($_SESSION['ID'])) {
        header('Location: /index.php');
        exit;
    }
}

function require_admin(): void
{
    require_login();
    if (($_SESSION['TIPO_USUARIO'] ?? '') !== 'Administrador') {
        http_response_code(403);
        exit('Acceso denegado');
    }
}

function current_user(): string
{
    return $_SESSION['USUARIO'] ?? '';
}
